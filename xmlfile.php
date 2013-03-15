<?php

/**
 * Description of xmlfile
 *
 * @author Joseph
 */
class xmlfile {

    public function xml_attribute($object, $attribute) {
        if (isset($object[$attribute])) {
            return (string) $object[$attribute];
        }
    }

    public function readOPML($xml) {

        $feedCount = $xml->body->outline->count();
        echo "There are {$feedCount} feeds.<br>" . PHP_EOL;
        for ($i = 0; $i < $feedCount; $i++) {
            $title = $this->xml_attribute($xml->body->outline[$i], 'title');
            $xmlURL = $this->xml_attribute($xml->body->outline[$i], 'xmlUrl');
            if (gettype($xmlURL) === 'NULL') {
                $title = 'Folder: ' . $title;
            }
            $htmlURL = $this->xml_attribute($xml->body->outline[$i], 'htmlUrl');
            $type = $this->xml_attribute($xml->body->outline[$i], 'type');
            echo "<a href=\"{$xmlURL}\">{$title}</a><br>" . PHP_EOL;
            // 17 The Big Picture locks up the getXML 
            //if ($i == 17) {
            if (gettype($xmlURL) !== 'NULL') {
                $feed = $this->getXML($xmlURL);
                echo $this->getXMLType($feed);
            }
            //}
        }
    }

    public function getXML($file) {
        $xml = simplexml_load_file($file);
        if ($xml === false) {
            echo "Failed loading XML<br>\n";
            foreach (libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
            exit;
        } else {
            return $xml;
        }
    }

    public function getXMLType($xml) {
        $xmlName = $xml->getName();
        switch ($xmlName) {
            case 'opml':
                return 'OPML';
            case 'rss':
                $namespaces = $xml->getNamespaces(true);
                $hasATOM = $this->existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
                return 'RSS';
            default:
                return 'Unknown';
        }
    }

    public function readRSS($xml) {

        $rssVersion = $this->xml_attribute($xml, 'version');
        echo "This is an RSS {$rssVersion} feed<br>" . PHP_EOL;
        $namespaces = $xml->getNamespaces(true);
        $hasATOM = $this->existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
        echo "<pre>";
        print_r($namespaces);
        print_r($xml->attributes());
        echo "</pre>";
    }

    public function readUnknown($xml) {
        $namespaces = $xml->getNamespaces(true);
        $hasATOM = $this->existsNSByVal($namespaces, 'http://www.w3.org/2005/Atom');
        echo "<pre>";
        print_r($namespaces);
        print_r($xml->attributes());
//print_r($xml);
        echo "<pre>";
    }

    function existsNSByVal($array, $value) {
        if (is_array($array)) {
            $return = array_search($value, $array);
            if ($return === FALSE) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

}