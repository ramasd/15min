<?php

namespace App\Models;

use App\Core\App;

class Article
{
    /**
     * @return mixed
     */
    public static function getAll(): mixed
    {
        return App::get('database')->selectAll("articles");
    }

    public static function getByUrl($url): mixed
    {
        return App::get('database')->select("articles", ['url' => $url]);
    }

    /**
     * @param array $values
     */
    public static function insert(array $values)
    {
        App::get('database')->insert('articles', $values);
    }

    /**
     * @param $rows
     */
    public static function insertMultiple($rows)
    {
        if ($rows) {
            App::get('database')->insertMultiple('articles', 'url', $rows);
        }
    }

    /**
     * @param $url
     * @return false|string
     */
    public static function getContentByUrl($url): bool|string
    {
        return file_get_contents($url);
    }
}