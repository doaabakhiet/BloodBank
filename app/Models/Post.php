<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    protected $table = 'posts';
    protected $fillable = ['photo', 'title', 'decription', 'category_id'];
    protected $appends = array('photo_full_path', 'isFavourite');
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public function getPhotoFullPathAttribute()
    {
        return asset($this->photo);
    }

    public function getisFavouriteAttribute()
    {
        // if(request()->user('clients')){

        // }
        if (request()->user()) {
            $data = request()->user()->whereHas('posts', function ($query) {
                $query->where('post_client.post_id', $this->id);
            })->first();
            if ($data) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client', 'post_client');
    }
}
