<?php

/**
 * Description of rssitem
 *
 * @author Joseph
 */
class rssitem {

    protected $rssItemLink = '';
    protected $rssItemTitle = '';

    function __construct($rssItem) {
        $this->rssItemLink = $rssItem->link;
        $this->rssItemTitle = $rssItem->title;
    }

    function __get($param) {
        return $this->$param;
    }

    function displayRssItem() {
        return "<a href=\"{$this->rssItemLink}\">{$this->rssItemTitle}</a>";
    }

}
