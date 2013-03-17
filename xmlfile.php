<?php

/**
 * Description of xmlfile
 *
 * @author Joseph
 */
class xmlfile {

    protected $xml;
    protected $xmlItems;

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

    public function getXML($file) {
//        echo "choo?$ {$file} $";

        $this->xml = simplexml_load_file($file);
        if ($this->xml === false) {
            echo "Failed loading {$file}<br>\n";
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
    public function getXMLType($file) {
        $this->getXML($file);
        $xmlName = $this->xml->getName();
//        $namespaces = $xml->getNamespaces(true);
        //$hasATOM = $this->existsNSByVal($namespaces, ATOM_NS);
        switch ($xmlName) {
            case 'opml': return 'OPML';
            case 'rss': return 'RSS';
            case 'feed': return 'ATOM';
            default: return 'Unknown';
        }
        $this->xml = NULL;
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