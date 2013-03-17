<?php

/**
 * Description of rssfile
 *
 * @author Joseph
 */
class rssfile extends xmlfile {

    protected $rssTitle = '';
    protected $rssLink = '';
    protected $rssDesc = '';
    protected $rssItemCount = 0;

    function parseRSS($rssFileURL) {
        parent::getXML($rssFileURL);
//        echo '<pre>';
//        print_r($this->xml);
//        echo '</pre>';
    }

    function getRSSInfo() {
        $this->rssTitle = $this->xml->channel->title;
        $this->rssLink = $this->xml->channel->link;
        $this->rssDesc = $this->xml->channel->description;
        $this->rssItemCount = $this->xml->channel->item->count();
    }

    function __get($name) {
        return $this->$name;
    }

    function getItems() {
        for ($item = 0; $item < $this->rssItemCount; $item++) {
            $rssItem = new rssitem($this->xml->channel->item[$item]);
            echo "<span class=\"feedItem\">&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\"removeMe(this);\">X</a> Item {$item}: " . $rssItem->displayRssItem() . "<br></span>" . PHP_EOL;
        }
    }

}
