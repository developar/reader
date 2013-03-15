<?php

error_reporting(E_ALL);

$feed = getXML('Takeout/subscriptions.xml');

switch (getXMLType($feed)) {
    case 'OPML':
        //echo 'OPML';

        break;

    default:
        break;
}

readOPML($feed);

function getXML($file) {
    libxml_use_internal_errors(true);
$xml = simplexml_load_file($file);
if ($xml === false) {
    echo "Failed loading XML\n";
    foreach(libxml_get_errors() as $error) {
        echo "\t", $error->message;
    }
    exit;
    } else {
        
        return $xml;
    }
}

function getXMLType($xml) {
    $xmlName = $xml->getName();
    switch ($xmlName) {
        case 'opml':
            return 'OPML';

        case 'rss':
            $hasATOM = existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
            return 'RSS';

        default:
            return 'Unknown';
    }
}

function readOPML($xml) {

    $feedCount = $xml->body->outline->count();
    echo "There are {$feedCount} feeds.<br>" . PHP_EOL;
    for ($i = 0; $i <= $feedCount; $i++) {
        $title = xml_attribute($xml->body->outline[$i], 'title');
        $xmlURL = xml_attribute($xml->body->outline[$i], 'xmlUrl');
        if (gettype($xmlURL) === 'NULL') {
            $title = 'Folder: ' . $title;
        }
        $htmlURL = xml_attribute($xml->body->outline[$i], 'htmlUrl');
        $type = xml_attribute($xml->body->outline[$i], 'type');
        echo "<a href=\"{$xmlURL}\">{$title}</a><br>" . PHP_EOL;
        // 17 The Big Picture locks up the getXML 
        if ($i == 17) {
            $feed = getXML($xmlURL);
            echo getXMLType($feed);
        }
    }
}

function readRSS($xml) {

    $rssVersion = xml_attribute($xml, 'version');
    echo "This is an RSS {$rssVersion} feed<br>" . PHP_EOL;
    $namespaces = $xml->getNamespaces(true);
    $hasATOM = existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
    echo "<pre>";
    print_r($namespaces);
    print_r($xml->attributes());
    echo "</pre>";
}

function readUnknown($xml) {
    $namespaces = $xml->getNamespaces(true);
    $hasATOM = existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
    echo "<pre>";
    print_r($namespaces);
    print_r($xml->attributes());
//print_r($xml);
    echo "<pre>";
}

function xml_attribute($object, $attribute) {
    if (isset($object[$attribute])) {
        return (string) $object[$attribute];
    }
}

function existsNSByVal($array, $value) {
    $return = array_search($value, $array);
    if ($return === FALSE) {
        return FALSE;
    } else {
        return TRUE;
    }
}

