<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post($post_id)
    {
        $post = Post::with('categories')->where('id', $post_id)->first();
        $relatedPosts=Post::where('category_id',$post->category_id)->get();
        // dd($relatedPosts);
        return view('frontend.pages.article-details',compact('post','relatedPosts'));
    }
}
