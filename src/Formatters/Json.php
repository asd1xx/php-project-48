<?php

namespace App\Formatters\Json;

function toJson(array $data): string
{
    return json_encode($data);
}
