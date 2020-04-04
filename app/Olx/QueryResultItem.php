<?php

namespace App\Olx;

use App\Olx\Traits\QueryResultSanitization;
use simplehtmldom_1_5\simple_html_dom_node;

class QueryResultItem
{
    use QueryResultSanitization;

    private $category;
    private $title;
    private $href;
    private $image;
    private $region;
    private $price;

    private function __construct(simple_html_dom_node $node)
    {
        $this->category = $this->extractCategory($node);
        $this->title = $this->extractTitle($node);
        $this->href = $this->extractHref($node);
        $this->image = $this->extractImage($node);
        $this->region = $this->extractRegion($node);
        $this->price = $this->extractPrice($node);
    }

    // private function __construct(array $attrs)
    // {
    //     $this->category = $attrs['category'];
    //     $this->title = $attrs['title'];
    //     $this->href = $attrs['href'];
    //     $this->image = $attrs['image'];
    //     $this->region = $attrs['region'];
    //     $this->price = $attrs['price'];
    // }

    public function getCategory() : string
    {
        return $this->category;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getHref() : string
    {
        return $this->href;
    }

    public function getImage() : string
    {
        return $this->image;
    }

    public function getRegion() : string
    {
        return $this->region;
    }

    public function getPrice() : string
    {
        return $this->price;
    }

    public static function make(simple_html_dom_node $node)
    {
        return new QueryResultItem($node);
    }

    private function extractTitle(simple_html_dom_node $node) : string
    {
        return self::sanitize($node->title);
    }

    private function extractPrice(simple_html_dom_node $node) : string
    {
        $price = $node->find('div p.OLXad-list-price', 0);
        return $price ? self::sanitize($price->plaintext) : 'R$ 0,00';
    }

    private function extractHref(simple_html_dom_node $node) : string
    {
        return self::sanitize($node->href);
    }

    private function extractImage(simple_html_dom_node $node) : string
    {
        $image = $node->find('img.image', 0);
        return $image ? $image->getAttribute('src') : '';
    }

    private function extractRegion(simple_html_dom_node $node) : string
    {
        return self::sanitize($node->find('div p.detail-region', 0)->innertext);
    }

    private function extractCategory(simple_html_dom_node $node) : string
    {
        $category = $node->find('div p.detail-category', 0);
        return $category ? self::sanitize($category->plaintext) : '';
    }

    public function toArray()
    {
        return [
            'category' => $this->category,
            'title' => $this->title,
            'href' => $this->href,
            'image' => $this->image,
            'region' => $this->region,
            'price' => $this->price,
        ];
    }
}