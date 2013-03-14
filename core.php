<?php

$xml = simplexml_load_file('Takeout/subscriptions.xml');
$xmlName = $xml->getName();
switch ($xmlName) {
    case 'opml':
        echo "This is an OPML file.<br>" . PHP_EOL;
        $feedCount = $xml->body->outline->count();
        echo "There are {$feedCount} feeds.<br>" . PHP_EOL;
        for ($i = 0; $i <= $feedCount; $i++) {
            $title = xml_attribute($xml->body->outline[$i], 'title');
            $xmlURL = xml_attribute($xml->body->outline[$i], 'xmlUrl');
            $htmlURL = xml_attribute($xml->body->outline[$i], 'htmlUrl');
            $type = xml_attribute($xml->body->outline[$i], 'type');
            echo "<a href=\"{$htmlURL}\">{$title}</a><br>" . PHP_EOL;
        }
        break;

    default:
        echo $xmlName;
        print_r($xml->attributes()) . "<br>";
        echo "<pre>";
        print_r($xml);
        echo "<pre>";
        break;
}

function xml_attribute($object, $attribute) {
    if (isset($object[$attribute])) {
        return (string) $object[$attribute];
    }
}

