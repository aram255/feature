<?php

namespace App\Http\Controllers;
require_once base_path('vendor\autoload.php');

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Zoom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class ZoomController extends Controller
{
    public function __construct(Request $request)
    {

        $api_secret = "N7M4hBgGRr5Lua0OTShVgprrupwbpPJDc0mh";
        $api_key = "8if_MHwmSt2nBbsxS55qzw";
        $payload = array(
            'iss' => $api_key,
            'exp' => (time() + 60)
        );

        $this->jwt = JWT::encode($payload, $api_secret);

        //create guzzle client
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        $response = $client->request('GET', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer ". $this->jwt
            ]
        ]);

        $data = json_decode($response->getBody());


        if ( !empty($data) ) {
            foreach ( $data->meetings as $d ) {
                $topic = $d->topic;
                $join_url = $d->join_url;
                echo "<h3>Topic: $topic</h3>";
                echo "Join URL: $join_url";
                echo '<br>';
            }
        }
    }

    public function index(request $request)
    {

        //  $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        // $response = $client->request('POST', '/v2/users/me/meetings', [
        //     "headers" => [
        //         "Authorization" => "Bearer " .$this->jwt
        //     ],
        //     'json' => [
        //         "topic" => "Myyyyyyy WordPress",
        //         "type" => 2,
        //         "start_time" => "2021-01-30T20:30:00", new Carbon('2020-08-12 10:00:00')
        //         "duration" => "30", // 30 mins
        //         "password" => "123456"
        //     ],
        // ]);

        // $data = json_decode($response->getBody());
        // echo "Join URL: ". $data->join_url;
        // echo "<br>";
        // echo "Meeting Password: ". $data->password;
        // echo '<br>';
        // echo "duration: ". $data->duration;

    }

    public function addZoomMeeting(request $request)
    {


        $request->validate([
            'm_name' => 'required',
            'type' => 'required',
            'birthdaytime' => 'required',
            'time' => 'required',
            'password' => 'required',
        ]);

       // dd($request->all());

          $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

         $response = $client->request('POST', '/v2/users/me/meetings', [
             "headers" => [
                 "Authorization" => "Bearer " .$this->jwt
             ],
             'json' => [
                 "topic" => $request->m_name,
                 "type" => $request->type,
//                 'timezone' => '(GMT+4:00) Baku, Tbilisi, Yerevan',
                 "start_time" => new Carbon($request->birthdaytime),
                 "duration" => "$request->time", // 30 mins
                 "password" => $request->password
             ],
         ]);
    }

    public function deleteZoomMeeting(request $request)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        $response = $client->request("DELETE", "/v2/meetings/73432645847", [
            "headers" => [
                "Authorization" => "Bearer " . $this->jwt
            ]
        ]);

        if (204 == $response->getStatusCode())
        {
            echo "Meeting deleted.";
        }

    }
}
