<?php

namespace Refersion\Shopify\Webhook;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class Subscription
{

  protected $config;

  public function __construct($config)
  {
    $this->config = $config;

    $this->config->base_uri = rtrim($this->config->base_uri, '/');
  }

  public function create($topic, $address)
  {
      $http_client = app('GuzzleHttpClient');

      $webhook = [
        'webhook' => [
          'topic' => $topic,
          'address' => $address,
          'format' => 'json',
        ]
      ];

      $url = $this->config->base_uri . "/admin/webhooks.json";
      $data = [
        'headers' => $this->getHeaders(),
        'json' => $webhook,
      ];

      try
      {
        $response = $http_client->request('POST', $url, $data);
        $result = $response->getBody()->getContents();

        return $result;
      }
      catch (RequestException $e)
      {
        $result = $e->getResponse()->getBody()->getContents();

        Log::error($result, [
          'url' => $url,
          'webhook' => $webhook,
        ]);

        return $result;
      } 
  }

  public function update($id, $address)
  {
      $http_client = app('GuzzleHttpClient');

      $webhook = [
        'webhook' => [
          'id' => $id,
          'address' => $address,
        ]
      ];

      $url = $this->config->base_uri . "/admin/webhooks/$id.json";
      $data = [
        'headers' => $this->getHeaders(),
        'json' => $webhook,
      ];

      try
      {
        $response = $http_client->request('PUT', $url, $data);
        $result = $response->getBody()->getContents();

        return $result;
      }
      catch (RequestException $e)
      {
        $result = $e->getResponse()->getBody()->getContents();

        Log::error($result, [
          'url' => $url,
        ]);

        return $result;
      }
  }

  public function find($id)
  {
      $http_client = app('GuzzleHttpClient');

      $url = $this->config->base_uri . "/admin/webhooks/$id.json";
      $data = [
        'headers' => $this->getHeaders(),
      ];

      try
      {
        $response = $http_client->request('GET', $url, $data);
        $result = $response->getBody()->getContents();

        return $result;
      }
      catch (ClientException $e) {

      }
      catch (RequestException $e)
      {
        $result = $e->getResponse()->getBody()->getContents();

        Log::error($result, [
          'url' => $url,
        ]);

        return $result;
      }
  }

  public function delete($id)
  {
      $http_client = app('GuzzleHttpClient');

      $url = $this->config->base_uri . "/admin/webhooks/$id.json";
      $data = [
        'headers' => $this->getHeaders(),
      ];

      try
      {
        $response = $http_client->request('DELETE', $url, $data);
        $result = $response->getBody()->getContents();

        return $result;
      }
      catch (RequestException $e)
      {
        $result = $e->getResponse()->getBody()->getContents();

        Log::error($result, [
          'url' => $url,
        ]);

        return $result;
      } 
  }

  public function count()
  {
      $http_client = app('GuzzleHttpClient');

      $url = $this->config->base_uri . "/admin/webhooks/count.json";
      $data = [
        'headers' => $this->getHeaders(),
      ];

      try
      {
        $response = $http_client->request('GET', $url, $data);
        $result = $response->getBody()->getContents();

        return $result;
      }
      catch (RequestException $e)
      {
        $result = $e->getResponse()->getBody()->getContents();

        Log::error($result, [
          'url' => $url,
        ]);

        return $result;
      }     
  }

  public function listAll() {
      $http_client = app('GuzzleHttpClient');

      $url = $this->config->base_uri . "/admin/webhooks.json";
      $data = [
        'headers' => $this->getHeaders(),
      ];

      try
      {
        $response = $http_client->request('GET', $url, $data);
        $result = $response->getBody()->getContents();

        return $result;
      }
      catch (RequestException $e)
      {
        $result = $e->getResponse()->getBody()->getContents();

        Log::error($result, [
          'url' => $url
        ]);

        return $result;
      }
  }

  protected function getHeaders()
  {
    return [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json',
          'X-Shopify-Access-Token' => $this->config->access_token,
        ];
  }
}