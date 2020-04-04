<?php

namespace App\Olx;

use App\State;
use Illuminate\Support\Collection;
use simplehtmldom_1_5\simple_html_dom;
use Sunra\PhpSimple\HtmlDomParser;

class Query extends Service
{
    /** @var string */
    private $url;

    /** @var State */
    private $state;

    public function __construct(State $state)
    {
        $this->url = sprintf("%s?q=", rtrim($state->url, ','));
        $this->state = $state;
    }

    public function search(string $term) : QueryResult
    {
        /** @var simple_html_dom */
        $doc = HtmlDomParser::str_get_html(file_get_contents($this->url . $term));

        /** @var QueryResult */
        $result = QueryResult::make($doc);

        $doc->clear();

        return $result;
    }
}