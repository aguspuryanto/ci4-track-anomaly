<?php

namespace App\Controllers;

use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\Exceptions\HTTPException;

class DashboardController extends BaseController
{
    private CURLRequest $client;
    private const API_URL = 'https://jontracking.com/';

    public function __construct()
    {
        $this->client = \Config\Services::curlrequest([
            'baseURI' => self::API_URL,
            'timeout' => 30,
            'verify' => false, // Only use this if you must skip SSL verification
        ]);
    }

    public function index()
    {
        try {
            $params = [
                'cmd' => 'load_event_list',
                'nd' => time(),
                '_search' => 'false',
                'rows' => 25,
                'page' => 1,
                'sidx' => 'dt_tracker',
                'sord' => 'desc'
            ];
            echo json_encode($params);

            $response = $this->client->get('func/fn_events.php', [
                'query' => $params,
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);

            $data = [
                'title' => 'Dashboard',
                'events' => json_decode($response->getBody(), true)
            ];

            // return view('dashboard/index', $data);

        } catch (HTTPException $e) {
            log_message('error', '[Dashboard] API Error: ' . $e->getMessage());
            $data = [
                'title' => 'Dashboard',
                'error' => 'Failed to fetch tracking data. Please try again later.'
            ];
        }

        return view('dashboard/index', $data);
    }
}
