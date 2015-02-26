<?php

function search($query, $network=false, $library=false, $offset=1)
{
    $sruQuery = new SruQuery();

    $pxml = $sruQuery->getResultsFromSearch($query, $network, $library, $offset);

    $response = new SwissbibResponse();
    $response->setHits((string)$pxml->numberOfRecords);

    if ($pxml->numberOfRecords > 0) {


        foreach ($pxml->records->record as $record) {


            $marc = $record->recordData->children('srw_marc', true);
            //$test = $record->recordData;
            //$marc = $record->recordData->children('http://www.w3.org/2001/XMLSchema', true);

            $vO = new SRUValueObject();

            $vO->setAuthor(getMarcField($marc, '245', 'c'));
            $vO->setTitle(getMarcField($marc, '245', 'a'));
            $vO->setPublicationDate(getMarcField($marc, '260', 'c'));
            $vO->setPublicationPlace(getMarcField($marc, '260', 'a'));
            $vO->setPublisher(getMarcField($marc, '260', 'b'));
            $vO->setEdition(getMarcField($marc, '250', 'a'));



            $holdings=$record->extraRecordData->children('http://oclc.org/srw/extraData');
            $holdings=$holdings->children('urn:oclc-srw:holdings');
            $holdings->registerXPathNamespace('ns3', 'urn:oclc-srw:holdings');
            $results=$holdings->xpath('ns3:datafield');


            foreach ($results as $item) {

                $libItem = new LibraryItems();

                $itemNetwork=getHoldingField($item,'B');
                $libItem->setItemNetwork($itemNetwork);
                //because network label will be changed in case of rero
                $itemNetworkBacklinkDictionary = $itemNetwork;

                $itemLibraryCode=getHoldingField($item,'b');

                if ( (substr($network,0,1)=='R' || $network==false)
                    && $itemNetwork=='RERO')
                {
                    //address searches in local rero networks, get library and network codes from $itemLibraryCode, i.e. 949$b
                    //for rero results, the 949$B is always RERO and not the local network codes
                    //the local network is in 949$b, first digit for RERO-FR and first and second digits for other rero networks
                    //the library code is in 949$b, digits 1-5 for RERO-FR and digits 1-6 for other rero networks
                    if (substr($itemLibraryCode,1,1)=="0") {//Rero Fribourg
                        if ($network!='R*') {
                            $itemNetwork='R1'; //i.e. R1
                        } else {
                            $itemNetwork='R*';
                        }
                        $itemLibraryCode='R'.substr($itemLibraryCode,0,4);
                    } else { //other rero
                        if ($network!='R*') {
                            $itemNetwork='R'.substr($itemLibraryCode,0,2);
                        } else {
                            $itemNetwork='R*';
                        }
                        $itemLibraryCode='R'.substr($itemLibraryCode,0,5);
                    }
                }




                if (MobileConfigs::getBacklinkType() === "SOURCESYSTEM") {
                    //send the user back to the source system

                    //$lsys = $sysIdsAsDictionary[$itemNetworkBacklinkDictionary];
                    $lsys = getHoldingField($item,'E');
                    $libItem->setLocalSystemNumber($lsys);


                    $backlink = "";

                    switch ($itemNetworkBacklinkDictionary) {
                        case "RERO":

                            //this is such a mess...
                            $reroMultiCode=getHoldingField($item,'b');


                            if (strlen($reroMultiCode) == 9) {
                                $subnetwork = substr($reroMultiCode,0,2);
                                $sublocalID = substr($reroMultiCode,0,5);

                                $backlink = sprintf(MobileConfigs::getBacklinkSourceSystem($itemNetworkBacklinkDictionary),$subnetwork,$lsys,$sublocalID);
                            }
                            elseif (strlen($reroMultiCode == 8)) {
                                $subnetwork = substr($reroMultiCode,0,1);
                                $sublocalID = substr($reroMultiCode,0,4);
                                $backlink = sprintf(MobileConfigs::getBacklinkSourceSystem($itemNetworkBacklinkDictionary),$subnetwork,$lsys,$sublocalID);

                            }
                            else {

                                //only as fallback in case the item doesn't match the general rule
                                $backlink = sprintf(MobileConfigs::getBacklinkSourceSystem($itemNetworkBacklinkDictionary),$itemNetwork,$lsys,$itemLibraryCode);

                            }

                            break;
                        case "SNL":
                        case "CCSA":
                            $backlink = sprintf(MobileConfigs::getBacklinkSourceSystem($itemNetworkBacklinkDictionary),$lsys);
                            break;
                        default:
                            //Alephsystems
                            $backlink = sprintf(MobileConfigs::getBacklinkSourceSystem($itemNetworkBacklinkDictionary),$lsys,$itemLibraryCode);
                    }

                    $libItem->setBacklink($backlink);



                }

                $libraryName=getHoldingField($item,'0');
                $libItem->setLibraryName($libraryName);
                $dispName = "";

                if ($itemNetwork=='SNL') { //Swiss National Library
                    $dispName = getLibraryName('S1');
                } else if (substr($itemNetwork,0,1)=='R' || $itemNetwork=='CCSA') {
                    $dispName = getLibraryName($itemLibraryCode);
                }
                $holdingsField = getHoldingField($item,'1');

                $secondCallNumber=getHoldingField($item,'s');
                //if ($secondCallNumber) {
                //    echo $secondCallNumber; //2nd call number (to be displayed first)
                //    echo ' ';
                //}

                $callNumber = getHoldingField($item,'j');
                $libItem->setCallNumber($callNumber);

                $vO->addItem($libItem);}


                $response->addValueObject($vO);
            }


    }
    return $response;
}



?>
