<?php
/**
 * Created by PhpStorm.
 * User: eien
 * Date: 09/10/2018
 * Time: 19:49
 */

namespace App\utils;


class StringHelper
{
    public static function makeSlug(string $title){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    }

}