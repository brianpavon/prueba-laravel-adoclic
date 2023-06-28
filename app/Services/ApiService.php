<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public function getEntities()
    {
        $response = Http::get('https://api.publicapis.org/entries');
        
        if ($response->ok()) {
            return $response->json()['entries'];
        }
        
        return [];
    }
}