<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class QuotesController extends Controller
{
    public function index() {
        return Inertia::render('Quotes', [
            'quotes' => $this->getQuotes(),
        ]);
    }

    public function getQuotes() {
        $quotes = [];
        for ($i = 0; $i < 5; $i++) {
            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://api.kanye.rest/text');
            array_push($quotes, $res->getBody()->getContents());
        }

        return $quotes;
    }
}
