<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class SunatController extends Controller
{
    public function exchange_rate()
    {
        $token = 'apis-token-2620.RyZsqk8rl5-8dLPyr94nieCqhu35uNkv';
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Referer' => 'https://apis.net.pe/api-sunat-tipo-de-cambio',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['fecha' => date('Y-m-d')]
        ];
        $res = $client->request('GET', '/v1/tipo-cambio-sunat', $parameters);
        $response = json_decode($res->getBody()->getContents(), true);
        // var_dump($response);
        return $response;
    }
}
