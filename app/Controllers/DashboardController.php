<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // https://jontracking.com/func/fn_events.php?cmd=load_event_list&_search=false&nd=1732420002679&rows=25&page=1&sidx=dt_tracker&sord=desc
        $options = [
            'CURLOPT_SSL_VERIFYPEER' => false
        ];
        $client = \Config\Services::curlrequest($options); 

        // $curl = \Config\Services::curlrequest();
        // $curl = service('curlrequest');
        // $client = service('curlrequest', [
        //     'baseURI' => 'https://jontracking.com/func/fn_events.php',
        // ]);

        // GET http:example.com/api/v1/photos
        // $client->get('photos');

        // $posts_data = $client->request("GET", "https://jontracking.com/func/fn_events.php", [
		// 	"headers" => [
		// 		"Accept" => "application/json"
		// 	],
		// 	"form_params" => [
		// 		"cmd" => "load_event_list",
		// 		"nd" => time(),
		// 		"_search" => false,
		// 		"rows" => 25,
		// 		"page" => 1,
		// 		"sidx" => "dt_tracker",
		// 		"sord" => "desc"
        //     ],
        //     "http_errors" => true
		// ]);

		// echo "<pre>";
		// print_r($posts_data->getBody());

        $params = [
            "cmd" => "load_event_list",
            "nd" => time(),
            "_search" => false,
            "rows" => 25,
            "page" => 1,
            "sidx" => "dt_tracker",
            "sord" => "desc"
        ];

        // $curl = $this->http_request("https://jontracking.com/func/fn_events.php?" . http_build_query($params));
        // $curl = $this->http_request("https://jontracking.com/func/fn_events.php", ($params));
        // echo "https://jontracking.com/func/fn_events.php?" . http_build_query($params) . "\n";

        $ch = curl_init("https://jontracking.com/func/fn_events.php?" . http_build_query($params));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $retdata = curl_exec($ch);
        $err = curl_error($ch);
        //echo $retdata;
        curl_close($ch);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $retdata;
        }

        return view('dashboard/index', ['title' => 'Dashboard']);
    }

    function http_request($url, $params=[]){
        // persiapkan curl
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // set user agent    
        // curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        // return the transfer as a string $curl = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $output contains the output string 
        $output = curl_exec($ch); 

        // tutup curl 
        curl_close($ch);      

        // mengembalikan hasil curl
        return json_decode($output, true);
    }
}
