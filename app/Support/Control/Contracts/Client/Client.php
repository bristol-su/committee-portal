<?php


namespace App\Support\Control\Contracts\Client;


use GuzzleHttp\ClientInterface;

interface Client
{
    public function request($method, $uri, array $options = []);
}
