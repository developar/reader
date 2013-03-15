<?php

/**
 * Description of xmlfile
 *
 * @author Joseph
 */
class xmlfile {

    var $xml;
    var $xmlItems;

    const ATOM_NS = 'http://www.w3.org/2005/Atom';

    /**
     * 
     * @param array $object
     * @param string $attribute
     * @return string
     */
    public function xml_attribute($object, $attribute) {
        if (isset($object[$attribute])) {
            return (string) $object[$attribute];
        }
    }

    private function readOPMLItem($itemNumber) {
        $title = $this->xml_attribute($this->xmlItems[$itemNumber], 'title');
        $xmlURL = $this->xml_attribute($this->xmlItems[$itemNumber], 'xmlUrl');
//            $htmlURL = $this->xml_attribute($xml->body->outline[$i], 'htmlUrl');

        if (gettype($xmlURL) !== 'NULL') {
            $feed = $this->getXML($xmlURL);
            $xmlType = $this->getXMLType($feed);
            switch ($xmlType) {
                case 'RSS':
                case 'ATOM':
                case 'OPML':
                    echo "1 {$xmlType} <a href=\"{$xmlURL}\">{$title}</a><br>" . PHP_EOL;

                    break;
                default:
                    echo "3 {$xmlType} <a href=\"{$xmlURL}\">{$title}</a><br>" . PHP_EOL;

                    break;
            }
        } else {
                    echo "2 Folder: {$title}<br>" . PHP_EOL;
            
        }
        if (gettype($xmlURL) !== 'NULL') {
            $feed = $this->getXML($xmlURL);
            //echo $this->getXMLType($feed);
        }
    }

    public function readOPML() {

        $this->xmlItems = $this->xml->body->outline;

        $feedCount = $this->xmlItems->count();
        echo "There are {$feedCount} feeds.<br>" . PHP_EOL;
        for ($i = 0; $i < $feedCount; $i++) {
            $this->readOPMLItem($i);
        }
    }

    public function getXML($file) {
        $this->xml = simplexml_load_file($file);
        if ($this->xml === false) {
            echo "Failed loading XML<br>\n";
            foreach (libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
            exit;
        }
    }

    /**
     * 
     * @param array $xml
     * @return string
     */
    public function getXMLType() {
        $xmlName = $this->xml->getName();
//        $namespaces = $xml->getNamespaces(true);
        //$hasATOM = $this->existsNSByVal($namespaces, ATOM_NS);
        switch ($xmlName) {
            case 'opml': return 'OPML';
            case 'rss': return 'RSS';
            default: return 'Unknown';
        }
    }

    public function readRSS() {

        $rssVersion = $this->xml_attribute($this->xml, 'version');
        echo "This is an RSS {$rssVersion} feed<br>" . PHP_EOL;
        echo "<pre>";
        print_r($namespaces);
        print_r($this->xml->attributes());
        echo "</pre>";
    }

    public function readUnknown() {
        echo "<pre>";
        print_r($namespaces);
        print_r($this->xml->attributes());
//print_r($xml);
        echo "<pre>";
    }

    /**
     * 
     * @param array $array
     * @param string $value
     * @return boolean
     */
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