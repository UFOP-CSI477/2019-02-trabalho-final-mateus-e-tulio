<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Publish a post.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function publish(Post $post)
    {
        //
    }
    
    /**
     * Retrieve service posts.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function services(Post $post)
    {
        //
    }
    
    /**
     * Retrieve freelancer posts.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function freelancers(Post $post)
    {
        //
    }
}
