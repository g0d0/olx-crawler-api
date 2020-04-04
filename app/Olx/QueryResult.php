<?php

namespace App\Olx;

use App\Olx\Traits\QueryResultSanitization;
use Illuminate\Support\Collection;
use simplehtmldom_1_5\simple_html_dom;

class QueryResult
{
    use QueryResultSanitization;

    /** @var Collection */
    private $items;
    
    public function __construct($items)
    {
        $this->items = $items->map(function ($resultItem) {
            return QueryResultItem::make($resultItem);
        });
    }

    public static function make(simple_html_dom $html) : QueryResult
    {
        return new QueryResult(collect($html->find('ul#main-ad-list li a')));
    }

    public function toArray()
    {
        return $this->items->map->toArray();
    }
}