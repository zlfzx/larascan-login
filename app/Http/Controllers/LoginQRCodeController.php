<?php

namespace App\Http\Controllers;

use App\Events\QRLoginEvent;
use App\Http\Requests\Auth\QRLoginRequest;
use Illuminate\Http\Request;
use DB;

class LoginQRCodeController extends Controller
{
    public function login(QRLoginRequest $request)
    {
        // get session ID
        $sessionId = $request->session;

        // get client session
        $session = DB::table('sessions')->find($sessionId);
        $arrSession = unserialize(base64_decode($session->payload));

        // get my session
        $mySession = DB::table('sessions')->find(session()->getId());
        $arrMySession = unserialize(base64_decode($mySession->payload));

        // set new session for client
        foreach($arrMySession as $key => $value) {
            if (str_contains($key, 'login_web')) {
                $arrSession[$key] = $value;
            }
        }
        $newSession = base64_encode(serialize($arrSession));

        DB::table('sessions')->where('id', $sessionId)->update([
            'user_id' => $mySession->user_id,
            'payload' => $newSession
        ]);

        broadcast(new QRLoginEvent($sessionId));

        return redirect()->route('dashboard')->with('login', 'Berhasil login');
    }
}
