<?php

use App\Models\General;

if (!function_exists('getCompanyCode')) {
    function getCompanyCode(): string
    {
        return General::first()?->code ?? 'default';
    }
}
