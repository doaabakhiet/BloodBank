<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
  public function createDonation(Request $request)
  {
    $data = validator($request->all(), [
      'name' => 'required',
      'bloodtype_id' => 'required',
      'num_of_bags' => 'required',
      'city_id' => 'required',
      'longtitude' => 'required',
      'latitude' => 'required',
      'phone' => 'required',
      'age' => 'required',
      // 'notes'=>'required',
    ]);
    if ($data->fails()) {
      return apiResponse(0, "validation failed", $data->errors());
    }
    $donatioRequest = $request->user()->donationRequests()->create($request->all());

    ///
    $clientIds = $donatioRequest->cities->governates
      ->clients()->whereHas('bloodTypes', function ($q) use ($request, $donatioRequest) {
        $q->where('blood_types.id', $donatioRequest->bloodtype_id);
      })->pluck('clients.id')->toArray();

    $notifications = $donatioRequest->notifications()->create([
      'title' => Auth::user()->name . '  يوجد حالة تبرع بالدم قريبة منك',
      'content' => $donatioRequest->bloodtype->name . " " . 'محتاج متبرع لفصيلة ',
      
    ]);

    $notifications->clients()->attach($clientIds);

    $token = Token::where('token', '!=', '')->whereIn('client_id', $clientIds)->pluck('token')->toArray();

    if (count($token)) {
      // $audiance = ['include_players_id'];
      $content = [
        'ar' => "  يوجد اشعار من" . $request->user()->name,
        'en' => "You Have new Notification" . $request->user()->name,
      ];
      $title = $notifications->title;
      $content = $notifications->content;
      $data = [
        // 'action' => 'new notify',
        // 'data' => null,
        // 'client' => 'client',
        // 'title' => $notifications->title,
        // 'content' => $notifications->content,
        'donation_request_id' => $donatioRequest->id
      ];
      info(json_encode($data));
      $send = notifyByFirebase($title, $content, $token, $data);
      info($send);
      info("firebase result" . $send);
      $send = json_encode($send);
    }
    return apiResponse(1, 'تم الاضافة بنجاح', $donatioRequest->load('cities'));
  }


  public function showDonationRequests(Request $request)
  {

    $data = DonationRequest::with(['bloodtype', 'cities'])
      ->whereHas('bloodtype', function ($q) use ($request) {
        $q->orWhere('blood_types.id', $request->bloodtype_id);
      })
      ->whereHas('cities', function ($q) use ($request) {
        $q->whereHas('governates', function ($q) use ($request) {
          $q->orWhere('governates.id', $request->governate_id);
        });
      })
      ->paginate();
    return apiResponse(1, "success", $data);
  }



  public function donationRequest($donationrequest_id)
  {
    $data = DonationRequest::with(['bloodtype', 'city'])
      ->find( $donationrequest_id);
    return apiResponse(1, "success", $data);
  }

}
