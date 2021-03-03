<?php

namespace App\Controllers;

use App\core\App;
use App\Models\Article;
use simple_html_dom;

class ArticlesController
{
    private $domain = 'https://www.15min.lt';

    /**
     * @return mixed
     */
    public function index(): mixed
    {
        $articles = App::get('database')->selectAll("articles");

        return view('index', compact('articles'));
    }

    public function store()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->domain);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        $domResults = new simple_html_dom();
        $domResults->load($result);
        $urls = [];

        foreach($domResults->find('article a.vl-img-container') as $element) {
            $this->addUniqUrlToArr($urls, $element, $this->domain);
        }

        foreach ($domResults->find('div[class^=item], div[class*=type_] a.item-image') as $element) {
            $this->addUniqUrlToArr($urls, $element, $this->domain);
        }

        foreach ($domResults->find('div.item-second-row a.item-image') as $element) {
            $this->addUniqUrlToArr($urls, $element, $this->domain);
        }

        foreach ($domResults->find('div[class^=post-item post-item-] div[class!="template-field field-xml_items field_banner_desktop"] a.item-image') as $element) {
            $this->addUniqUrlToArr($urls, $element, $this->domain);
        }

        foreach ($domResults->find('div[class^=post-item post-item-] a[class="template-field field-link field_link main-image-link"]') as $element) {
            $this->addUniqUrlToArr($urls, $element, $this->domain);
        }

        foreach ($domResults->find('div[class^="widget news widget-"] div.widget-vertical-items div.list.clearfix div[class^="item article-"] a.image-holder') as $element) {
            $this->addUniqUrlToArr($urls, $element, $this->domain);
        }

        foreach ($domResults->find('a.item-image') as $element) {
            $this->addUniqUrlToArr($urls, $element, $this->domain);
        }

        // gets URL without duplicates
        $urls = array_map("unserialize", array_unique(array_map("serialize", $urls)));

        Article::insertMultiple($urls);
    }

    /**
     * @param $urls
     * @param $element
     * @param $domain
     */
    public function addUniqUrlToArr(&$urls, $element, $domain)
    {
        if ($element->href && !str_contains($element->href, 'https://www.15min.lt')) {
            $element->href = $domain . $element->href;
        }

        $articles = Article::getAll();
        $isNewUrl = empty($this->findAllWithUrl($articles, $element->href));
        if ($element->href && $isNewUrl && !str_contains($element->href, 'https://bit.ly/')) {
            $urls[] = ['url' => $element->href];
        }

    }

    /**
     * @param $objects
     * @param $url
     * @return array
     */
    public function findAllWithUrl($objects, $url): array
    {
        return array_filter($objects, function($object) use ($url) {
            return $object->url == $url;
        });
    }
}