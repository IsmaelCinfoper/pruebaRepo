<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Devuelve la información meteorológica de Porcuna en formato JSON.
     */
    public function porcuna()
    {
        $response = Http::get('https://wttr.in/Porcuna?format=j1');

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json([
            'error' => 'Unable to fetch weather data'
        ], $response->status());
    }
}
