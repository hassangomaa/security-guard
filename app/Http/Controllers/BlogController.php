<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //


    //show all blogs
    public function showAllBlogs()
    {
        $blogs = Blog::all();
        return view('blogs', compact('blogs'));
    }

    // showOneBlog
    public function showOneBlog($id)
    {
        $blog = Blog::find($id);
        return view('readBlog', compact('blog'));
    }


    //showContactMe
    public function showContactMe()
    {
        return view('contacts');
    }
}
