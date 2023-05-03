<?php

namespace App\Infrastructure\Services;

use Exception;
use GuzzleHttp\Client;

final class Location
{
    public function __construct(private Client $client)
    {
    }


    public function getPublicIP()
    {
        try {
            $response = $this->client->get('https://api.ipify.org');
            $ip = $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new Exception('No se pudo obtener la dirección IP pública');
        }

        return $ip;
    }
}
