<?php

/**
 * Description of opmlfile
 *
 * @author Joseph
 */
class opmlfile extends xmlfile {

    protected $opmlItems;

    protected function readOPMLItem($itemNumber) {
        $opmlItemTitle = $this->xml_attribute($this->opmlItems[$itemNumber], 'title');
        $opmlItemURL = $this->xml_attribute($this->opmlItems[$itemNumber], 'xmlUrl');
        //              echo "foo$ {$opmlItemURL} $";
//            $htmlURL = $this->xml_attribute($xml->body->outline[$i], 'htmlUrl');

        if (gettype($opmlItemURL) !== 'NULL') {
//            echo 'Item: '.$opmlItemURL;
            $opmlItemType = $this->getXMLType($opmlItemURL);
            switch ($opmlItemType) {
                case 'RSS':
                    //@TODO: Enable RSS support
                    $rssFeed = new rssfile();
                    $rssFeed->parseRSS($opmlItemURL);
                    $rssFeed->getRSSInfo();
                    $numberOfRssItems = $rssFeed->__get('rssItemCount');
                    echo "1 {$opmlItemType} {$numberOfRssItems} <a href=\"" . htmlentities($opmlItemURL) . "\">{$opmlItemTitle}</a><br>" . PHP_EOL;
                    $rssFeed->getItems();
                    
                    break;
                case 'ATOM':
                    //@TODO: Enable ATOM support
                    //echo "1 {$opmlItemType} <a href=\"" . htmlentities($opmlItemURL) . "\">{$opmlItemTitle}</a><br>" . PHP_EOL;

                    break;
                case 'OPML':
                    //@TODO: Enable OPML within OPML support
                    //echo "1 {$opmlItemType} <a href=\"" . htmlentities($opmlItemURL) . "\">{$opmlItemTitle}</a><br>" . PHP_EOL;

                    break;
                case 'Unknown':
                    //@TODO: Enable Unknown support
                    //echo "1 {$opmlItemType} <a href=\"" . htmlentities($opmlItemURL) . "\">{$opmlItemTitle}</a><br>" . PHP_EOL;

                    break;

                default:
                    echo "4 {$opmlItemType} <a href=\"" . htmlentities($opmlItemURL) . "\">{$opmlItemTitle}</a><br>" . PHP_EOL;

                    break;
            }
        } else {
            //@TODO: Enable folder support
            //echo "2 Folder: {$opmlItemTitle}<br>" . PHP_EOL;
        }
    }

    public function readOPML($opmlFile) {
        parent::getXML($opmlFile);

        $this->opmlItems = $this->xml->body->outline;

        $feedCount = $this->opmlItems->count();
        echo "There are {$feedCount} feeds.<br>" . PHP_EOL;
        for ($i = 0; $i < $feedCount; $i++) {
            $this->readOPMLItem($i);
        }
    }

}
