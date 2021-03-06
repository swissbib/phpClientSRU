<?php

class SruQuery
{
	//private $_baseUrl="http://sru.swissbib.ch/SRW/search/?";
    //private $_baseUrl="http://localhost:8080/sru/search?";
    private $_baseUrl="http://sru.swissbib.ch/sru/search?";
    //private $_baseUrl="http://sru.swissbib.ch/sru/search?";

	private $_standardParameters="&version=1.1&operation=searchRetrieve&recordSchema=info%3Asrw%2Fschema%2F1%2Fmarcxml-v1.1&resultSetTTL=300&recordPacking=xml&maximumRecords=10";
    //private $_standardParameters="&version=1.1&operation=searchRetrieve&recordSchema=marcns&resultSetTTL=300&recordPacking=xml&maximumRecords=10";


    function getResultsFromSearch($query, $network, $library, $offset=1)
	{
		//$queryParameter="&query=dc.anywhere+%3D+%22".urlencode($query)."%22";
        $queryParameter= $this->getQueryParameter($query,$library,$network);
        $queryParameter .= $this->getStandardParameters();
        $queryParameter .= "&startRecord=".$offset ;


        $url=$this->_baseUrl.$queryParameter;
        return $this->sendToSru($url);
		
	}

    //not used
	function getRecordFromIdWithHoldings($id)
	{
		$queryParameter="&query=dc.id+%3D+%22".$id."%22";
		$recordOffset="&startRecord=1";
		$withHoldings="&x-info-10-get-holdings=true";
		$url=$this->_baseUrl.$queryParameter.$this->_standardParameters.$recordOffset.$withHoldings;		
		return $this->sendToSru($url);
	}

    //not used
	function getSpellSuggestion($query)
	{
		//no nebis because it gets a spell suggestion
		$queryParameter="&query=dc.anywhere+%3D+%22".urlencode($query)."%22";
		$spellSuggestion="&x-info-7-spelling=true";
		$recordOffset="&startRecord=1";
		$url=$this->_baseUrl.$queryParameter.$this->_standardParameters.$recordOffset.$spellSuggestion;
		$pxml=$this->sendToSru($url);
		
		$spell=$pxml->extraResponseData->children('ns4',true);
		$spell=$spell->children('spellings',true);
		$spell->registerXPathNamespace('spellings', 'urn:oclc-srw:spellings');
		$spell_suggestion=$spell->xpath('spellings:spelling/spellings:replacement/spellings:replacementText');
		
		if($spell_suggestion){		
			return $spell_suggestion[0];
		}
		else {
			return False;
		}
		
		
	}
	
	private function sendToSru($url)
	{


        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
        //old style from old mobile client
        $response = @file_get_contents($url, false,$context);


		if ($response === False)
		{
            throw new Exception ('no connection to SRU server');

		}
		else
		{	
			$pxml = simplexml_load_string($response);
			if ($pxml === False)
				{
                    throw new Exception ('could not parse response');
				}
			
			return $pxml;
		}
					
	}


    private function getStandardParameters ()
    {
        //at the moment I have fifficultis to parse the MARC_LIGHT namespace with PHP
        $_standardParameters= array(
            'version' => '1.1',
            'operation' => 'searchRetrieve',
            'recordSchema' => SchemaTypes::MARC_OCLC,
            //'recordSchema' => SchemaTypes::MARC_LIGHT,
            'resultSetTTL' => '300',
            'recordPacking' => 'xml',
            'maximumRecords' => '10',
            'x-info-10-get-holdings' => 'true'

        );

        $par = "";

        foreach ($_standardParameters as $key => $value)
        {
            $par .= '&' . $key . '=' . $value;

        }
        return $par;
    }



    private function getQueryParameter ($query, $library, $network)
    {
        $queryFields= array(
            'anywhere' => 'dc.anywhere',
        );

        $par = "&query=+" . $queryFields['anywhere'] . "%3D+" . urlencode($query);

        if($network){
            $par .= "+and+dc.xNetwork+%3D+%22".$network."%22";
        }

        if($library){
            $par .= "+and+dc.possessingInstitution+%3D+%22".$library."%22";
        }

        $par .= '&';


        return $par;
    }

	
}

?>
