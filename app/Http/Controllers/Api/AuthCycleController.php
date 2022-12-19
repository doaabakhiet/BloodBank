<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Client;
use App\Models\BloodType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthCycleController extends Controller
{
    //logout
    public function logout(Request $req)
    {
        $req->user()->api_token = '';
        $req->user()->save();
        return apiResponse(1, 'تم تسجيل الخروج بنجاح', $req->user());
    }
    //post
    public function post($post_id)
    {
        $data = Post::with('categories')->where('id', $post_id)->first();
        return apiResponse(1, "success", $data);
    }
    //posts ----
    public function posts(Request $req)
    {
        $data = Post::with('categories')->where(function ($query) use ($req) {
            if ($req->has('category_id')) {
                $query->where('category_id', $req->category_id);
            }
            if ($req->has('search_text') && $req->search_text != '') {
                $query->orWhere('title', 'like', '%' . $req->search_text . '%')
                    ->orWhere('decription', 'like', '%' . $req->search_text . '%');
            }
        })->get();
        return apiResponse(1, "success", $data);
    }
    //contact us
    public function contactUs(Request $req)
    {
        $validation = validator($req->all(), [
            'contact_title' => 'required',
            'content' => 'required',
        ]);
        if ($validation->fails()) {
            return apiResponse(0, "validation failed", $validation->errors());
        }
        $data = $req->user()->contacts()->create([
            'title' => $req->contact_title,
            'content' => $req->content
        ]);
        return apiResponse(1, "success", $data);
    }

    public function profile()
    {
        $data = Client::with(['bloodtype', 'cities'])->where('id', Auth::user()->id)->first();
        return apiResponse(1, "Success", $data);
        // return $req->user();
    }
    public function updateProfile(Request $req)
    {
        $validation = validator()->make($req->all(), [
            'password' => 'required|confirmed',
            'email' => Rule::unique('clients')->ignore($req->user()->id),
            'phone' => Rule::unique('clients')->ignore($req->user()->id),

        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, 'Failed', $data);
        }
        // $req->merge(['password' => bcrypt($req->password)]);
        $loginuser = $req->user();
        $loginuser->update($req->all());

        if ($req->has('governate_id')) {
            $loginuser->governates()->detach($req->governate_id);
            $loginuser->governates()->attach($req->governate_id);
        }

        if ($req->has('blood_type')) {
            $blood_type = BloodType::where('name', $req->blood_type)->first();
            $loginuser->bloodTypes()->detach($blood_type->id);
            $loginuser->bloodTypes()->attach($blood_type->id);
        }
        return apiResponse(1, "Success", $req->user());
    }
    //Favourites
    public function addToFavourite(Request $req)
    {
        $validation = validator()->make($req->all(), [
            'post_id' => 'required|exists:posts,id',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, 'Failed', $data);
        }
        $toggle = $req->user()->posts()->toggle($req->post_id);
        return apiResponse(1, "Data Added Successfully", $toggle);
    }
    public function ShowFavourotes(Request $req)
    {
        $favourites = $req->user()->posts()->latest()->paginate(10);
        return apiResponse(1, "Success", $favourites);
    }

    //client settings
    public function clientSetting(Request $req){
        $bloodtypes=$req->user()->bloodTypes()->get();
        $governates=$req->user()->governates()->get();
        return apiResponse(1, 'Success', [
            'bloodTypes'=>$bloodtypes,
            'governorates'=>$governates
        ]);
    }
    public function editClientSetting(Request $req)
    {
        $validation = validator()->make($req->all(), [
            'bloodtype_id' => 'required|array',
            'bloodtype_id.*' => 'required|exists:blood_types,id',
            'governorate_id' => 'required|exists:governates,id',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, 'Failed', $data);
        }
        $bloodTypeClient = $req->user()->bloodTypes()->sync($req->bloodtype_id);
        $governorateClinet = $req->user()->governates()->sync($req->governorate_id);
        if ($bloodTypeClient || $governorateClinet) {
            return apiResponse(1, 'تم تسجيل الاشعارات بنجاح');
        }
    }
}
