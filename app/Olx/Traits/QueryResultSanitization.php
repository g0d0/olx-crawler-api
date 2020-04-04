<?php

namespace App\Olx\Traits;

trait QueryResultSanitization
{
    private function sanitize(string $value) : string
    {
        return trim(utf8_encode(str_replace("\t", '', $value)));
    }
}