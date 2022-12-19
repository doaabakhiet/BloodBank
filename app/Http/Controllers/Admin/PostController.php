<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('categories')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.add_post', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'photo'=>'required',
            'decription'=>'required',
            'category_id'=>'required',
        ]);
        $post=Post::create($request->except('_token'));
        if ($request->HasFile('photo')) {
            $image= $request->file('photo');
            $ext = $image->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image->move("images/", $filename);
            $post->photo=$filename;
            $post->save();
        }
        flash()->success('Post Added Successfully');
        return redirect(route('dashboard.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit_post',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::findOrFail($id);
        $path='images/'.$post->photo;
        if(File::exists($path)){
            File::delete($path);
        }
        $post->update($request->except('image'));
        if ($request->HasFile('photo')) {
            $image= $request->file('photo');
            $ext = $image->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image->move("images/", $filename);
            $post->update(['photo'=>$filename]);
        }
        flash()->success('Post Updated Successfully');
        return redirect(route('dashboard.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        $path='images/'.$post->photo;
        if(File::exists($path)){
            File::delete($path);
        }
        $post->delete();
        flash()->success('Post Deleted Successfully');
        return back();
    }
}
