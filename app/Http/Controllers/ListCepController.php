<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ListCepController extends Controller
{
    public function listCep(Request $request)
    {
        $cep = $request->cep;

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $responseApiCep = $client->get("https://viacep.com.br/ws/$cep/json/");

        // Decodifica o JSON retornado pela API
        $data = json_decode($responseApiCep->getBody()->getContents(), true);

        if (!empty($data)) {
            return $data;
        }

        return false;
    }
}
