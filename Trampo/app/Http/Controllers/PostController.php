<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function publish()
    {
        $categorias = Category::orderBy('name')->get();
        return view('post.publish',compact('categorias'));
    }

    public function storePublish(Request $request)
    {

    }
    

    public function services(Post $post)
    {
        return view('post.services',);
    }
    

    public function freelancers(Post $post)
    {

    }
}
