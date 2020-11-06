<?php


namespace App\Services;
use Symfony\Component\HttpClient\HttpClient;

class GeoApi
{
    public function getCity()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://geo.api.gouv.fr/communes');
        return $response->getContent();
    }

}