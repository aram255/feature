<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Zoom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Mail;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\ZoomModel;

class ZoomController extends Controller
{
    public function __construct(Request $request)
    {
        include  base_path("vendor/autoload.php");
        $this->middleware('auth');
    }

    public function jwt()
    {
        $api_secret = Auth::user()->api_secret;
        $api_key    = Auth::user()->api_key;
        $payload    = array(
            'iss'   => $api_key,
            'exp'   => (time() + 60)
        );

        $this->jwt = JWT::encode($payload, $api_secret);
    }



    public function index(request $request)
    {
           $this->jwt();
           //create guzzle client
           $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

           $response = $client->request('GET', '/v2/users/me/meetings', [
               "headers" => [
                   "Authorization" => "Bearer ". $this->jwt
               ]
           ]);


         // $data = json_decode($response->getBody());
          $data = ZoomModel::where('user_id',Auth::user()->id)->get();



          return view('customer-meetings-list',compact('data'));


    }

//    public function addZoomMeeting(request $request)
//    {
//        $this->jwt();
//
//        $request->validate([
//            'm_name' => 'required',
//            'birthdaytime' => 'required',
//            'time' => 'required',
//            'password' => 'required',
//        ]);
//
//
//         $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
//
//         $response = $client->request('POST', '/v2/users/me/meetings', [
//             "headers" => [
//                 "Authorization" => "Bearer " .$this->jwt
//             ],
//             'json' => [
//                 "topic" => $request->m_name,
//                 "type" => 2,
//               //'timezone' => '(GMT+4:00) Baku, Tbilisi, Yerevan',
//                 "start_time" => new Carbon($request->birthdaytime),
//                 "duration" => "$request->time", // 30 mins
//                 "password" => $request->password
//             ],
//         ]);
//
//
//        $get = $client->request('GET', '/v2/users/me/meetings', [
//            "headers" => [
//                "Authorization" => "Bearer ". $this->jwt
//            ]
//        ]);
//
//        $GetData = json_decode($get->getBody());
//        $JoinUrl  = end($GetData->meetings);
//
//
//         if($response->getStatusCode() == 201)
//         {
//
////             Mail::send('email.zoom-from-customer',
////                 [
////                    'title' => $request->m_name,
////                    'start_time' => new Carbon($request->birthdaytime),
////                    'duration' => $request->time,
////                    'password' => $request->password,
////                    'JoinUrl' => $JoinUrl->join_url,
////                    'email' => Auth::user()->email,
////                    'first_name' => $request->first_name,
////                    'last_name' => $request->last_name,
////                    'phone_number' => $request->phone_number
////
////                 ], function($message) use ($request) {
////                 $message->from($request->email);
////                 $message->to($request->email);
////                 $message->subject('Generate Zoom Meeting');
////             });
//
//             $Add = new ZoomModel;
//             $Add->title            = $request->m_name;
//             $Add->start_date_time  = new Carbon($request->birthdaytime);
//             $Add->duration         = $request->time;
//             $Add->join_url         = $JoinUrl->join_url;
//             $Add->password         = $request->password;
//             $Add->meeting_id       = $JoinUrl->id;
//             $Add->user_id          = Auth::user()->id;
//             $Add->practitioner_id  = $request->practitioner_id;
//             $Add->save();
//
//             return redirect(app()->getLocale().'/zoom')->with('status', 'Profile updated!');
//         }else{
//             echo 'Zoom No Creat Meetings';
//         }
//    }

    public function addZoomMeeting(request $request)
    {
        $this->jwt();

        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'duration' => 'required|integer',
            'password' => 'required',
        ]);


        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer " .$this->jwt
            ],
            'json' => [
                "topic" => $request->title,
                "type" => 2,
                //'timezone' => '(GMT+4:00) Baku, Tbilisi, Yerevan',
                "start_time" => new Carbon($request->start),
                "duration" => "$request->duration", // 30 mins
                "password" => $request->password
            ],
        ]);


        $get = $client->request('GET', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer ". $this->jwt
            ]
        ]);

        $GetData = json_decode($get->getBody());
        $JoinUrl  = end($GetData->meetings);


        if($response->getStatusCode() == 201)
        {

//             Mail::send('email.zoom-from-customer',
//                 [
//                    'title' => $request->m_name,
//                    'start_time' => new Carbon($request->birthdaytime),
//                    'duration' => $request->time,
//                    'password' => $request->password,
//                    'JoinUrl' => $JoinUrl->join_url,
//                    'email' => Auth::user()->email,
//                    'first_name' => $request->first_name,
//                    'last_name' => $request->last_name,
//                    'phone_number' => $request->phone_number
//
//                 ], function($message) use ($request) {
//                 $message->from($request->email);
//                 $message->to($request->email);
//                 $message->subject('Generate Zoom Meeting');
//             });

            $Add = new ZoomModel;
            $Add->title            = $request->title;
            $Add->start            = new Carbon($request->start);
            $Add->end              = new Carbon($request->end);
            $Add->duration         = $request->duration;
            $Add->join_url         = $JoinUrl->join_url;
            $Add->password         = $request->password;
            $Add->meeting_id       = $JoinUrl->id;
            $Add->user_id          = Auth::user()->id;
            $Add->practitioner_id  = $request->practitionerID;
            $Add->save();

            return response()->json($Add);
        }else{
            echo 'Zoom No Creat Meetings';
        }
        return response()->json($JoinUrl);
    }

    public function deleteZoomMeeting(request $request)
    {
        $this->jwt();

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        $response = $client->request("DELETE", "/v2/meetings/".$request->delete_meeting_id, [
            "headers" => [
                "Authorization" => "Bearer " . $this->jwt
            ]
        ]);

        if (204 == $response->getStatusCode())
        {
            $Delete = ZoomModel::where("id",$request->delete_id);

            $Delete->delete();

            return response()->json($Delete);
           // return  back()->with('status','Delete Zoom Meeting');
        }
        return response()->json($response);
    }

    public function deleteZoomMeetingTable(request $request)
    {
        $this->jwt();

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        $response = $client->request("DELETE", "/v2/meetings/".$request->delete_meeting_id, [
            "headers" => [
                "Authorization" => "Bearer " . $this->jwt
            ]
        ]);

        if (204 == $response->getStatusCode())
        {
            $Delete = ZoomModel::where("id",$request->delete_id);

            $Delete->delete();
            return  back()->with('status','Delete Zoom Meeting');
        }

    }

    public function getData()
    {
       $GetData = ZoomModel::where('user_id',Auth::user()->id)->get();


    }
}
