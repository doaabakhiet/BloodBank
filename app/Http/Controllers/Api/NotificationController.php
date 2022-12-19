<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function registerToken(Request $req)
    {
        $validation = validator()->make($req->all(), [
            'token' => 'required',
            'platform' => 'required|in:android,IOS'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, "Failed", $data);
        }
        Token::where('token', $req->token)->delete();
        $req->user()->tokens()->create($req->all());
        return apiResponse(1, "تم التسجيل بنجاح");
    }
    public function removeToken(Request $req)
    {
        $validation = validator()->make($req->all(), [
            'token' => 'required',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, "Failed", $data);
        }
        Token::where('token', $req->token)->delete();
        return apiResponse(1, "تم الحذف بنجاح");
    }
    public function notificationList(Request $req)
    {
        $data = $req->user()->notifications()->with('donationRequests')->paginate(10);
        return apiResponse(1, "success", $data);
    }
    public function notificationCount(Request $req)
    {
        $data = $req->user()->notifications()->count();
        return $data;
    }
    public function notification($id, Request $req)
    {
        $notification=$req->user()->notifications()->with('donationRequests')->
        where('notification_id',$id)->first();
        $notification->pivot->update(['isread' => 1]);
        return apiResponse(1, "success", $notification);
    }
}
