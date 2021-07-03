<?php

namespace App\Mappers;

use Illuminate\Support\Arr;

class MenuSaveMapper
{
    /**
     * @param array $data
     * @return array
     */
    public static function map(array $data): array
    {
        return [
            'item' => Arr::get($data, 'name', ''),
            'category' => Arr::get($data, 'category', '')
        ];
    }
}
