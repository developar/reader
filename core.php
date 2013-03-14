<?php

$feed = getXML('Takeout/subscriptions.xml');

switch (getXMLType($feed)) {
    case 'OPML':
        echo 'OPML';

        break;

    default:
        break;
}

function getXML($file) {
    $xml = simplexml_load_file($file);
    return $xml;
}

function getXMLType($xml) {
    $xmlName = $xml->getName();
    switch ($xmlName) {
        case 'opml':
            return 'OPML';

        case 'rss':
            $rssVersion = xml_attribute($xml, 'version');
            echo "This is an RSS {$rssVersion} feed<br>" . PHP_EOL;
            $namespaces = $xml->getNamespaces(true);
            $hasATOM = existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
            echo "<pre>";
            print_r($namespaces);
            print_r($xml->attributes());
            echo "</pre>";
            break;

        default:
            echo $xmlName;
            $namespaces = $xml->getNamespaces(true);
            $hasATOM = existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
            echo "<pre>";
            print_r($namespaces);
            print_r($xml->attributes());
//print_r($xml);
            echo "<pre>";
            break;
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
        getXML($xmlURL);
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

