<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function (Request $request) {

    $game = $request->input('game');

    if ($game === 'duo') {
        $number = 2;
    } elseif ($game === 'squad') {
        $number = 4;
    } else {
        $number = 1;
    }

    $response = Http::withoutVerifying()->get(
        'https://random-word-api.herokuapp.com/word?length=5&lang=pt-br&number=' . $number
    );

    $words = collect($response->json() ?? [])
        ->map(fn ($w) => strtoupper($w))
        ->toArray();

    return view('welcome', [
        'words' => $words,
    ]);
});