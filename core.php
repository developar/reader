<?php

error_reporting(E_ALL);
libxml_use_internal_errors(true);

require_once 'xmlfile.php';
require_once 'opmlfile.php';
require_once 'rssfile.php';
require_once 'rssitem.php';


$feedFile = new xmlfile();

switch ($feedFile->getXMLType('Takeout/subscriptions.xml')) {
    case 'OPML':
        $opmlFile = new opmlfile();
        $opmlFile->readOPML('Takeout/subscriptions.xml');

        break;

    default:
        break;
}