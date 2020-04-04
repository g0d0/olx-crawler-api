<?php

namespace App\Olx;

use App\Category;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Sunra\PhpSimple\HtmlDomParser;

class Categories extends Service
{
    public function sync() : void
    {
        logger()->info('Sync categories started');

        $doc = HtmlDomParser::str_get_html(file_get_contents('https://sp.olx.com.br'));

        /** @var Collection */
        $olxCategories = collect($doc->find('#search-category a'))
            ->map(function ($categoryLink) {
                return Category::make([
                    'name' => utf8_encode(trim($categoryLink->innertext)),
                    'url' => $categoryLink->href,
                ]);
            });

        /** @var EloquentCollection */
        $categories = Category::all();

        $this->deleteIfNeeded($olxCategories, $categories);
        $this->insertIfNeeded($olxCategories, $categories);

        $doc->clear();
        logger()->info('Sync categories finished');
    }

    private function insertIfNeeded(Collection $olxCategories, EloquentCollection $categories)
    {
        /** @var Collection */
        $names = $categories->map->name;
        $olxCategories->each(function ($category) use ($names) {
            if ( ! $names->contains($category->name) ) {
                $category->save();
            }
        });
    }

    private function deleteIfNeeded(Collection $olxCategories, EloquentCollection $categories)
    {
        /** @var Collection */
        $names = $olxCategories->map->name;
        $categories->each(function ($category) use ($names) {
            if ( ! $names->contains($category->name) ) {
                $category->delete();
            }
        });
    }
}