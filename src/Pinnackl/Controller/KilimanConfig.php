<?php

namespace Pinnackl\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;

/**
 * Kiliman
 */
class KilimanConfig
{
    public function changesAction(Request $request, \Silex\Application $app)
    {
        // Get the helper
        $helper = $app['helper'];

        // Retreive the config
        $baseApi = $helper->getConfig('baseApi');
        $apiKey = $helper->getConfig('apiKey');
        $adminWebToken = $helper->getConfig('adminWebToken');
        $guzzleOpt = $helper->getConfig('guzzleOpt');

        // Make the request to the Umbrella API
        $client = new Client($guzzleOpt);

        // Set headers
        $res = $client->request('GET', $baseApi . '/config/pending_changes', [
            'headers' => [
                'X-Api-Key' => $apiKey,
                'X-Admin-Auth-Token' => $adminWebToken,
            ]
        ]);

        // Send the Respnse
        $response = new Response($res->getBody());
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function publishAction(Request $request, \Silex\Application $app)
    {
        // Get the helper
        $helper = $app['helper'];

        // Retreive the config
        $baseApi = $helper->getConfig('baseApi');
        $apiKey = $helper->getConfig('apiKey');
        $adminWebToken = $helper->getConfig('adminWebToken');
        $guzzleOpt = $helper->getConfig('guzzleOpt');

        // Handle the POST request
        $data = $request->getContent();

        // Make the request to the Umbrella API
        $client = new Client($guzzleOpt);

        // Set headers
        $res = $client->request('POST', $baseApi . '/apis.json', [
            'headers'       => [
                'content-type' => 'application/json',
                'X-Api-Key' => $apiKey,
                'X-Admin-Auth-Token' => $adminWebToken,
            ],
            'body'          => $data
        ]);

        // Send the Respnse
        $response = new Response($res->getBody());
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}