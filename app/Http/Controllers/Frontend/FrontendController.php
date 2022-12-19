<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governate;
use App\Models\Post;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class FrontendController extends Controller
{
    public function contact()
    {
        $settings = AppSetting::find(1);
        return view('frontend.pages.contact', compact('settings'));
    }
    public function contactForm(Request $request)
    {
        $this->validate($request,  [
            'title' => 'required',
            'content' => 'required',
          ]);

          $contact=Contact::create($request->all());
          flash()->success('تم تسجيل طلبك ...!');
        return redirect()->back();
    }
    public function whoAreUs()
    {

        return view('frontend.pages.who-are-us');
    }
    public function requests(Request $request)
    {
        $donationRequest = DonationRequest::with(['bloodtype', 'cities'])
            ->paginate(3);

        if ($request->ajax()) {
            $donationRequest = DonationRequest::with(['bloodtype', 'cities'])
                ->whereHas('bloodtype', function ($q) use ($request) {
                    if ($request->bloodtype_id != "null") {
                        $q->where('blood_types.id', $request->bloodtype_id);
                    }
                })
                ->whereHas('cities', function ($q) use ($request) {
                    $q->whereHas('governates', function ($q) use ($request) {
                        if ($request->governate_id != "null") {
                            $q->where('governates.id', $request->governate_id);
                        }
                    });
                })
                ->get();
            $output = output($donationRequest);
            return response()->json(['output' => $output]);
        }
        //  dd($donationRequest);

        $bloodtypes = BloodType::all();
        $governorates = Governate::all();
        return view('frontend.pages.requests', compact('donationRequest', 'bloodtypes', 'governorates'));
    }
    public function donationDetail($id)
    {
        $request = DonationRequest::with(['bloodtype', 'cities'])
            ->find($id);
        return view('frontend.pages.request-detail', compact('request'));
    }
    public function createAccount()
    {
        $governorates = Governate::all();
        $bloodtypes = BloodType::all();
        return view('frontend.pages.create-account',compact('governorates','bloodtypes'));
    }
    public function createDonation(Request $request){
        $donationRequest=request()->user();
        $this->validate($request,  [
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
          flash()->success("تم تسجيل طلب التبرع الخاص بك");

        return redirect()->back();
        //   return apiResponse(1, 'تم الاضافة بنجاح', $donatioRequest->load('cities'));
    }
    public function index(Request $request)
    {
        $posts = Post::take(8)->latest()->get();
        $donationRequest = DonationRequest::with(['bloodtype', 'cities'])
            ->whereHas('bloodtype', function ($q) use ($request) {
                $q->orWhere('blood_types.id', $request->bloodtype_id);
            })
            ->whereHas('cities', function ($q) use ($request) {
                $q->whereHas('governates', function ($q) use ($request) {
                    $q->orWhere('governates.id', $request->governate_id);
                });
            })
            ->paginate(3);

        if ($request->ajax()) {
            $donationRequest = DonationRequest::with(['bloodtype', 'cities'])
                ->whereHas('bloodtype', function ($q) use ($request) {
                    if ($request->bloodtype_id != "null") {
                        $q->where('blood_types.id', $request->bloodtype_id);
                    }
                })
                ->whereHas('cities', function ($q) use ($request) {
                    $q->whereHas('governates', function ($q) use ($request) {
                        if ($request->governate_id != "null") {
                            $q->where('governates.id', $request->governate_id);
                        }
                    });
                })
                ->get();
            $output = output($donationRequest);
            return response()->json(['output' => $output]);
        }
        $bloodtypes = BloodType::all();
        $governorates = Governate::all();
        return view('index', compact('posts', 'donationRequest', 'bloodtypes', 'governorates'));
    }
    public function showDonationRequest(Request $request)
    {
        $donationRequest = DonationRequest::with(['bloodtype', 'cities'])
            ->whereHas('bloodtype', function ($q) use ($request) {
                $q->orWhere('blood_types.id', $request->bloodtype_id);
            })
            ->whereHas('cities', function ($q) use ($request) {
                $q->whereHas('governates', function ($q) use ($request) {
                    $q->orWhere('governates.id', $request->governate_id);
                });
            })
            ->paginate(3);
        return response()->json(['status' => $donationRequest]);
    }
    public function getGovernorateCities(Request $request)
    {
        $cities = City::where("governate_id", $request->gov_id)->get();

        return response()->json($cities);
    }
    public function toggleFavouite(Request $request)
    {
        if ($request->post_id) {
            $toggle = $request->user()->posts()->toggle($request->post_id);
            if ($toggle) {
                return response()->json(['msg' => 'Product Added To Favourite']);
            }
        }
    }
}
