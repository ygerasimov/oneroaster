<?php

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;

namespace OneRoaster;

/**
 * Class Client
 *
 * Documentation
 * Getting Started https://developer.classlink.com/docs/getting-started-with-oneroster-1
 * API https://sandbox.oneroster.com/learningdata/v1
 */
class Client {
  protected $config;

  protected $client;

  public function __construct($token, $path_to_description = __DIR__ . '/../service_description.json') {
    $client = new Client();
    $client->setDefaultOption('headers/Authorization', 'Bearer ' . $token);

    $description_data = json_decode(file_get_contents($path_to_description));
    $description = new Description($description_data);

    $this->client = new GuzzleClient($client, $description);
  }
  
  public function __call($name, $arguments) {
    $this->client->{$name}($arguments);
  }
}