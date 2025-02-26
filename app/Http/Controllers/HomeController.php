<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('home',  compact('posts'));
    }
}
