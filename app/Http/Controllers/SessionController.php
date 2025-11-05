<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Exception;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getThreeSessions(Request $request)
    {
        try{
            $sessions = Session::limit(3)->get();
            if($request->wantsJson()){
                return response()->json([
                    'status'=> 'succes',
                    'data'=>$sessions
                ]);
            }
            return view('sessions.home',compact('sessions'));

        }catch (Exception $e){
            return response()->json([
                'status'=> 'error',
                'message'=> $e
            ],500);

        }
    }
}
