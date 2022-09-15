<?php

namespace App\Http\Controllers\Api;

use App\Models\FavoriteQuotes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use App\Http\Controllers\Controller;


class QuotesApiController extends Controller
{
    public function getQuotes($count = 1): JsonResponse {

        $quotes = [];
        for ($i = 0; $i < $count; $i++) {
            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://api.kanye.rest/text');
            array_push($quotes, $res->getBody()->getContents());
        }

        return response()->json($quotes);
    }
}
