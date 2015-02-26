<?php


/**
* really simple client to use the classic swissbib SRU interface
*
* PHP version 5
*
* Copyright (C) swissbib.org 2015
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 2,
* as published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*
* @author   Günter Hipler <guenter.hipler@unibas.ch>
* based on mobile client
* @link https://github.com/swissbib/swissbibMobile
* @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
* @link    http://www.swissbib.org
*/



include("include/Header.php");



$keyArray = [
    'eins' => 11,
    'zwei'  => 10


];

$noKeysArray = [
    2,5,1,10,3
];

    $myAsort =  asort($keyArray);
    $noKeySort = sort($noKeysArray);
    sort($keyArray);

    $testNoKeyWithAsort = asort($noKeysArray);




if (isset($_REQUEST["q"])) {

    $offset = isset($_REQUEST["offset"]) ? isset($_REQUEST["offset"]) : 1;

    if (isset($_REQUEST["network"]))
    {
        $network = $_REQUEST["network"];
    }

    if (isset($_REQUEST["library"]))
    {
        $library = $_REQUEST["library"];
    }



    $documents =  search($_REQUEST["q"], $network, $library, $offset);
    print_r($documents);


    //go ahead! now use the returned documents



}

