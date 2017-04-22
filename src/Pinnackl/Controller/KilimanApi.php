<?php

namespace Pinnackl\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;

/**
 * Kiliman
 */
class KilimanApi
{
    public function createAction(Request $request, \Silex\Application $app)
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

    public function listAction(Request $request, \Silex\Application $app)
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
        $res = $client->request('GET', $baseApi . '/apis', [
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

    public function showAction(Request $request, \Silex\Application $app)
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
        $res = $client->request('GET', $baseApi . '/apis', [
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

    public function updateAction(Request $request, \Silex\Application $app)
    {
        return '';
    }

    public function deleteAction(Request $request, \Silex\Application $app)
    {
        return '';
    }
}