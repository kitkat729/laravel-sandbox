<?php

namespace App\Http\Controllers\Shopify;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

class NotificationController extends Controller
{

  public function post(Request $request)
  {
    // shopify webhook headers
    $topic = $request->header('X-Shopify-Topic');
    $sha = $request->header('X-Shopify-Hmac-Sha256');
    $domain = $request->header('X-Shopify-Shop-Domain');

    switch ($topic) {
      case 'products/create':
        $products = json_decode($request->getContent());

        $keyword = 'rfsnadid';  // abbrev for "refersion affiliate id"
        $http_client = app('GuzzleHttpClient');

        //Log::info('Affiliate created products: '.$request->getContent());

        /**
         * The variants array will always be created. The array may contain the base product itself
         * or variations of the base product
         */
        foreach ($products->variants as $product) {
          if (($pos = strpos($product->sku, $keyword)) !== false) {
            $affiliate_code = substr($product->sku, $pos+strlen($keyword)+1, strlen($product->sku));

            // create Refersion Conversion trigger
            $url = 'https://www.refersion.com/api/new_affiliate_trigger';
            $data = [
              'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
              ],
              'json' => [
                'refersion_public_key' => config('refersion.api.public_key'),
                'refersion_secret_key' => config('refersion.api.secret_key'),
                'affiliate_code' => $affiliate_code,
                'type' => 'SKU',
                'trigger' => $product->sku,
              ]
            ];

            try
            {
              $response = $http_client->request('POST', $url, $data);

              // get json object from response contents
              //$json = json_decode($response->getBody()->getContents());
            }
            catch (RequestException $e)
            {
              // There is nothing the caller/user can do about the error, so just log it
              Log::error($e->getResponse()->getBody()->getContents(), [
                'affiliate_code' => $affiliate_code,
                'trigger' => $product->sku,
              ]);
            }

          }
        }
        break;
    }
  }
}