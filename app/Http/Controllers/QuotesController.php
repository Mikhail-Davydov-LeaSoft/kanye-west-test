<?php

namespace App\Http\Controllers;

use App\Models\FavoriteQuotes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class QuotesController extends Controller
{
    public function index() {
        return Inertia::render('Quotes', [
            'quotes' => $this->getQuotes()->getData(),
        ]);
    }

    public function getQuotes(): JsonResponse {
        $quotes = [];
        for ($i = 0; $i < 5; $i++) {
            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://api.kanye.rest/text');
            array_push($quotes, $res->getBody()->getContents());
        }

        return response()->json($quotes);
    }
}
