<?php

namespace App\Http\Controllers;


use http\Env\Response;
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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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


//         $data = json_decode($response->getBody());
//
//
//        $JoinUrl  = $data->meetings;
//
//        dd($JoinUrl);


       // $data = ZoomModel::where('user_id',Auth::user()->id)->get();
        $data = DB::table('practitioner')->join('zoom_meetings_list', 'practitioner.id', '=', 'zoom_meetings_list.practitioner_id')->where('zoom_meetings_list.user_id',Auth::user()->id)->get();

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
        $CheckService = ZoomModel::where('service_id', $request->service_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($CheckService == null || !empty($request->too_meet)) {


            $this->jwt();

            $request->validate([
                'title' => 'required',
                'start' => 'required',
                'duration' => 'required|integer',
                'password' => 'required',
            ]);


            // kisata
//            $CheckSelectMeetingProtocol = ZoomModel::where('practitioner_id',$request->practitionerID)
//                ->where('start',$request->start)
//                ->where('end',$request->end)
//                ->where('service_id',$request->service_id)
//                ->where('user_id','=',null)
//                ->first();
//
//            return $request->service_id;


            $CheckSelectMeeting = ZoomModel::where('practitioner_id',$request->practitionerID)
                                  ->where('start',$request->start)
                                  ->where('end',$request->end)
                                  ->first();

//            return response()->json(['ok' =>  $request->start .'=>'. $request->end]);
//          //  dd('d');
            if($CheckSelectMeeting != null ) {


                $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

                $response = $client->request('POST', '/v2/users/me/meetings', [
                    "headers" => [
                        "Authorization" => "Bearer " . $this->jwt
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
                        "Authorization" => "Bearer " . $this->jwt
                    ]
                ]);

                $GetData = json_decode($get->getBody());
                $JoinUrl = end($GetData->meetings);


                $code = Str::random(50);
                $Accept = 'Accepted';
                $Reject = 'Rejected';
                $Pending = 'Pending';

                $URLAccept = request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Accept;
                $URLReject = request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Reject;

                if ($response->getStatusCode() == 201) {
                    $code = Str::random(50);



                    $Add = new ZoomModel;
                    $Add->title = $request->title;
                    $Add->start = new Carbon($request->start);
                    $Add->end = new Carbon($request->end);
                    $Add->duration = $request->duration;
                    $Add->join_url = $JoinUrl->join_url;
                    $Add->password = $request->password;
                    $Add->meeting_id = $JoinUrl->id;
                    $Add->user_id = Auth::user()->id;
                    $Add->practitioner_id = $request->practitionerID;
                    $Add->check_code = $code;
                    $Add->status = $Pending;
                    $Add->service_id = $request->service_id;
                    $Add->create = $request->LiveDateTime;
                    $Add->save();
                    if(!empty($Add->id))
                    {
                        $mail = Mail::send('email.zoom-from-customer',
                            [
                                'title' => $request->title,
                                'start_time' => new Carbon($request->birthdaytime),
                                'duration' => $request->time,
                                'password' => $request->password,
                                'JoinUrl' => $JoinUrl->join_url,
                                'email' => $request->email,
                                'first_name' => $request->first_name,
                                'last_name' => $request->last_name,
                                'phone_number' => $request->phone_number,
                                'URLAccept' => request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Accept.'/'.$request->user_email.'/'.str_replace(' ', '_', $request->title).'/'.$request->first_name.'/'.$request->last_name,
                                'URLReject' => request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Reject.'/'.$request->user_email.'/'.str_replace(' ', '_', $request->title).'/'.$request->first_name.'/'.$request->last_name,

                            ], function ($message) use ($request) {
                                $message->from($request->email);
                                $message->to($request->email);
                                $message->subject('Generate Zoom Meeting');
                            });
                        return response()->json($mail);
                    }


                } else {
                    echo 'Zoom No Creat Meetings';
                }
                return response()->json($JoinUrl);
            } else {
                return response()->json(['NoRepeatService' => 'You have already fixed it.']);
            }
        }else{
            return  response()->json(['select_error' => 'The date you specified does not match the date provided by your doctor.']);
        }
    }

    public function deleteZoomMeeting(request $request)
    {
        $CheckDelete = ZoomModel::where('meeting_id', $request->delete_meeting_id)
            ->first();
        $date1 = $CheckDelete->create;
        $date2 = now()->toDateTimeString();
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        $hour = abs($timestamp2 - $timestamp1) / (60 * 60);
        $ChekHour = number_format($hour);

        if ($ChekHour >= 12) {
            $this->jwt();


            $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

//            $response = $client->request("DELETE", "/v2/meetings/".$request->delete_meeting_id, [
//                "headers" => [
//                    "Authorization" => "Bearer " . $this->jwt
//                ]
//            ]);
//
//
//        if (204 == $response->getStatusCode())
//        {
//            $Delete = ZoomModel::where("id",$request->delete_id);
//
//            $Delete->delete();
//
//            return response()->json($Delete);
//
//        }

            // Get  Data  zoom meeting
            $GetData = $client->request('GET', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer " . $this->jwt
                ]
            ]);
            $data = json_decode($GetData->getBody());


            // Check Meeting ID zomm Api
            $ZID = [];
            foreach ($data->meetings as $ZoomID) {
                if ($ZoomID->id == $request->delete_meeting_id) {
                    $ZID[] = $ZoomID->id;
                }
            }


            // Delete meeting zoom Api
            if (!empty($ZID[0])) {
                $response = $client->request("DELETE", "/v2/meetings/" . $ZID[0], [
                    "headers" => [
                        "Authorization" => "Bearer " . $this->jwt
                    ]
                ]);
            }

            // Delete meeting zoom sql
            // 204 == $response->getStatusCode()
            if (!empty($request->delete_id)) {
                $Delete = ZoomModel::where("id", $request->delete_id);

                $Delete->delete();
                return back()->with('status', 'Delete Zoom Meeting');
            }

            return response()->json($response);
        }
    }

    public function deleteZoomMeetingTable(request $request)
    {
        $CheckDelete = ZoomModel::where('meeting_id', $request->delete_meeting_id)
            ->first();
        $date1 = $CheckDelete->create;
        $date2 = now()->toDateTimeString();
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        $hour = abs($timestamp2 - $timestamp1) / (60 * 60);
        $ChekHour = number_format($hour);

        if ($ChekHour >= 12) {

            $this->jwt();

            $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);


            // Get  Data  zoom meeting
            $GetData = $client->request('GET', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer " . $this->jwt
                ]
            ]);
            $data = json_decode($GetData->getBody());


            // Check Meeting ID zomm Api
            $ZID = [];
            foreach ($data->meetings as $ZoomID) {
                if ($ZoomID->id == $request->delete_meeting_id) {
                    $ZID[] = $ZoomID->id;
                }
            }


            // Delete meeting zoom Api
            if (!empty($ZID[0])) {
                $response = $client->request("DELETE", "/v2/meetings/" . $ZID[0], [
                    "headers" => [
                        "Authorization" => "Bearer " . $this->jwt
                    ]
                ]);
            }


            // Delete meeting zoom sql
            // 204 == $response->getStatusCode()
            if (!empty($request->delete_id)) {
                $Delete = ZoomModel::where("id", $request->delete_id);

                $Delete->delete();
                return back()->with('status', 'Delete Zoom Meeting');
            }
        }else{
            return back()->with('status', 'You can change the date only 12 hours in advance.');
        }
    }

    public function getData()
    {
        $GetData = DB::table('zoom_meetings_list')->join('practitioner', 'practitioner.id', '=', 'zoom_meetings_list.practitioner_id')->where('zoom_meetings_list.user_id',Auth::user()->id)->get();

    }

//    public function confirmMeeting($lang,$Code,$Status)
//    {
//
//        $ChangeStatus =  ZoomModel::where('check_code',$Code)->first();
//        if($ChangeStatus != null)
//        {
//
//
//            $ChangeStatus->check_code = '?'.$Code;
//            $ChangeStatus->status     = $Status;
//            $ChangeStatus->save();
//            if(isset($ChangeStatus->status) && $ChangeStatus->status == 'Accept')
//            {
//                return redirect()->route('index',[app()->getLocale()])->with('status', 'Your meeting approved.');
//
//            }elseif(isset($ChangeStatus->status) && $ChangeStatus->status == 'Reject'){
//
//                return redirect()->route('index',[app()->getLocale()])->with('status', 'Your meeting rejected.');
//            }
//
//        }else{
//            return redirect()->route('index',[app()->getLocale()])->with('status', 'You can not change the status again.');
//        }
//
//
//    }

    public function update(request $request)
    {

        $CheckSelectMeeting = ZoomModel::
             where('start', $request->start)
            ->where('end', $request->end)
            ->first();

        if($CheckSelectMeeting != null) {

            $this->jwt();

            $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

            $response = $client->request("PATCH", "/v2/meetings/" . $request->meeting_id, [
                "headers" => [
                    "Authorization" => "Bearer " . $this->jwt
                ],
                'json' => [
                    "topic" => $request->title,
                    "type" => 2,
                    "start_time" => new Carbon($request->start),
                    "duration" => "$request->duration", // 30 mins
                    "password" => $request->password
                ],
            ]);

            if ($response->getStatusCode() == 204) {

                $code = Str::random(50);
                $Accept = 'Accepted';
                $Reject = 'Rejected';
                $Pending = 'Pending';

                $URLAccept = request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Accept;
                $URLReject = request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Reject;

                Mail::send('email.zoom-from-customer',
                    [
                        'title' => $request->title,
                        'start_time' => new Carbon($request->start),
                        'duration' => $request->duration,
                        'password' => $request->password,
                        'JoinUrl' => $request->join_url,
                        'email' => Auth::user()->email,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone_number' => $request->phone_number,
                        'URLAccept' => request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Accept.'/'.$request->user_email.'/'.str_replace(' ', '_', $request->title).'/'.$request->first_name.'/'.$request->last_name,
                        'URLReject' => request()->getHttpHost() . '/' . app()->getLocale() . '/confirm-meeting/' . $code . '/' . $Reject.'/'.$request->user_email.'/'.str_replace(' ', '_', $request->title).'/'.$request->first_name.'/'.$request->last_name,

                    ], function ($message) use ($request) {
                        $message->from($request->email);
                        $message->to($request->email);
                        $message->subject('Update Zoom Meeting');
                    });

                $Edit = ZoomModel::where('meeting_id', $request->meeting_id)
                    ->first();
                $date1 = $Edit->create;
                $date2 = now()->toDateTimeString();
                $timestamp1 = strtotime($date1);
                $timestamp2 = strtotime($date2);
                $hour = abs($timestamp2 - $timestamp1) / (60 * 60);
                $ChekHour = number_format($hour);

                if ($ChekHour >= 12) {
                    $Edit->title = $request->title;
                    $Edit->start = new Carbon($request->start);
                    $Edit->end = new Carbon($request->end);
                    $Edit->duration = $request->duration;
                    $Edit->password = $request->password;
                    $Edit->check_code = $code;
                    $Edit->status = 'Pending';
                    $Edit->save();

                    return response()->json($Edit);
                } else {
                    return response()->json(['Hour' => 'You can change the date only 12 hours in advance.']);
                }


            }
//        $response = $client->request("DELETE", "/v2/meetings/72358533771", [
//            "headers" => [
//                "Authorization" => "Bearer " . $this->jwt
//            ]
//        ]);

        }else{
            return  response()->json(['select_error' => 'The date you specified does not match the date provided by your doctor.']);
        }
    }
}
