<?php

namespace App\Olx;

use App\State;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Sunra\PhpSimple\HtmlDomParser;

class States extends Service
{
    public function sync() : void
    {
        logger()->info('Sync states started');

        $doc = HtmlDomParser::str_get_html(file_get_contents('https://www.olx.com.br'));

        /** @var Collection */
        $olxStates = collect($doc->find('div.states-wrapper a'))
            ->map(function ($stateLink) {
                return State::make([
                    'name' => utf8_encode(trim($stateLink->innertext)),
                    'url' => $stateLink->href,
                ]);
            });

        /** @var EloquentCollection */
        $categories = State::all();

        $this->deleteIfNeeded($olxStates, $categories);
        $this->insertIfNeeded($olxStates, $categories);

        $doc->clear();
        logger()->info('Sync states finished');
    }

    private function insertIfNeeded(Collection $olxStates, EloquentCollection $categories)
    {
        /** @var Collection */
        $names = $categories->map->name;
        $olxStates->each(function ($state) use ($names) {
            if ( ! $names->contains($state->name) ) {
                $state->save();
            }
        });
    }

    private function deleteIfNeeded(Collection $olxStates, EloquentCollection $categories)
    {
        /** @var Collection */
        $names = $olxStates->map->name;
        $categories->each(function ($state) use ($names) {
            if ( ! $names->contains($state->name) ) {
                $state->delete();
            }
        });
    }
}