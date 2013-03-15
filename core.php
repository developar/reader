<?php

error_reporting(E_ALL);
libxml_use_internal_errors(true);

require_once 'xmlfile.php';

$feedFile = new xmlfile();
$feedFile->getXML('Takeout/subscriptions.xml');

switch ($feedFile->getXMLType()) {
    case 'OPML':
        //echo 'OPML';

        break;

    default:
        break;
}

$feedFile->readOPML();

