<?php

namespace App\Transformers;

use Illuminate\Support\Arr;

class MenuFetchAllTransformer
{
    /**
     * @param array $data
     * @return array
     */
    public static function transform(array $data): array
    {
        $transformedData = [];

        foreach ($data as $menuitem) {
            $transformedData[] = [
                "item" => Arr::get($menuitem, 'item', ''),
                "category" => Arr::get($menuitem, 'category', '')
            ];
        }

        return $transformedData;
    }

    /**
     * @param array $data
     * @return array
     */
    public static function transformLinks(array $data): array
    {
        return [
            "first" => Arr::get($data, 'first_page_url'),
            "last" => Arr::get($data, 'last_page_url'),
            "prev" => Arr::get($data, 'prev_page_url'),
            "next" => Arr::get($data, 'next_page_url')
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public static function transformMeta(array $data): array
    {
        return [
            "current_page" => Arr::get($data, 'current_page', 1),
            "from" => Arr::get($data, 'from', 0),
            "last_page" => Arr::get($data, 'last_page', 1),
            "path" => Arr::get($data, 'path', ''),
            "per_page" => Arr::get($data, 'per_page', 15),
            "to" => Arr::get($data, 'to', 0),
            "total" => Arr::get($data, 'total', 0),
        ];
    }
}
