<?php

namespace OneRoaster;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;



/**
 * Class Client
 *
 * Documentation
 * Getting Started https://developer.classlink.com/docs/getting-started-with-oneroster-1
 * API https://sandbox.oneroster.com/learningdata/v1
 */
class Client {
  protected $client;

  public function __construct($token, $path_to_description = __DIR__ . '/../service_description.json') {
    $client = new GuzzleHttpClient();
    $client->setDefaultOption('headers/Authorization', 'Bearer ' . $token);

    $description_data = json_decode(file_get_contents($path_to_description), TRUE);
    $description = new Description($description_data);

    $this->client = new GuzzleClient($client, $description);
  }
  
  public function __call($name, $arguments) {
    return $this->client->{$name}($arguments);
  }
}