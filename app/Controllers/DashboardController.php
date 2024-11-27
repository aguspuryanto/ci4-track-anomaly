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
            // Login
            $doLogin = $this->doLogin();

            if($doLogin) {
                $params = [
                    'api' => 'user',
                    'key' => $_ENV['API_KEY'],
                    'cmd' => 'user_get_objects'
                ];

                $urlTo = self::API_URL . "api/api.php?" . http_build_query($params);
                // echo $urlTo . "\n";
                $response = $this->fetchData($urlTo);

                // $response = file_get_contents(FCPATH . '/assets/data/event.json');
                // echo var_dump($response);
                $responseJson = json_decode($response, true);
                $newObjects = [];
                foreach( $responseJson as $key => $object ) {
                    // echo "Driver Info Plate: " . $object['plate_number'] . "<br />\n";
                    $newObjects[$key] = $object;
                    $newObjects[$key]['timeline'] = [
                        [
                            'location' => 'Start Point',
                            'scheduled_time' => '2024-11-05 08:28:46',
                            'status' => 'On Time',
                            'actual_time' => '2024-11-05 08:48:26',
                        ],
                        [
                            'location' => 'Location A',
                            'scheduled_time' => '2024-11-05 10:30:46',
                            'status' => 'On Time',
                            'actual_time' => '2024-11-05 10:30:26',
                        ],
                        [
                            'location' => 'Location B',
                            'scheduled_time' => '2024-11-05 12:10:46',
                            'status' => 'On Time',
                            'actual_time' => '2024-11-05 12:10:26',
                        ],
                        [
                            'location' => 'Location C',
                            'scheduled_time' => '2024-11-05 13:00:46',
                            'status' => 'On Time',
                            'actual_time' => '2024-11-05 13:00:26',
                        ],
                        [
                            'location' => 'Location D',
                            'scheduled_time' => '2024-11-05 14:00:46',
                            'status' => 'On Time',
                            'actual_time' => '2024-11-05 14:00:26',
                        ],
                        [
                            'location' => 'Location E',
                            'scheduled_time' => '2024-11-05 14:30:46',
                            'status' => 'On Time',
                            'actual_time' => '2024-11-05 14:32:26',
                        ],
                        [
                            'location' => 'End Point',
                            'scheduled_time' => '2024-11-05 21:00:46',
                            'status' => 'On Time',
                            'actual_time' => '2024-11-05 21:00:26',
                        ]
                    ];
                }
            }
            // echo json_encode($newObjects);

            $data = [
                'title' => 'Dashboard',
                'dataObjects' => ($newObjects)
            ];

        } catch (HTTPException $e) {
            log_message('error', '[Dashboard] API Error: ' . $e->getMessage());
            $data = [
                'title' => 'Dashboard',
                'error' => 'Failed to fetch tracking data. Please try again later.'
            ];
        }

        return view('dashboard/index', $data);
    }

    function doLogin() {
        // http://localhost/jontracking/login.php?username=internal&password=230191
        $params = [
            'username' => 'internal',
            'password' => 230191
        ];
        // echo json_encode($params);

        $urlTo = self::API_URL . "login.php?" . http_build_query($params);
        $response = $this->fetchData($urlTo);
        // echo var_dump($response);
        // Split into lines
        $lines = explode("\n", $response);
        foreach($lines as $num => $line){
            // echo $line . "<br />\n";
        }

        return $response;
    }
    
    function fetchData($url) {
        $cookieFilePath = ROOTPATH . 'cookie.txt';

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_COOKIEJAR => $cookieFilePath,
            CURLOPT_COOKIEFILE => $cookieFilePath,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ]);

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            $errorMessage = curl_error($ch);
            curl_close($ch);
            // throw new Exception("cURL Error: $errorMessage");
        }

        // Close cURL session
        curl_close($ch);

        return $response;
    }
}
