<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;


class HomepageController extends Controller
{
    //

    public function index(){
        $posts = Post::latest()->take(3)->get();
        $categories = Category::with('posts')->latest()->take(3)->get();

        SEOMeta::setTitle('Homepage - Belajar', " ");
        SEOMeta::setDescription('This is my page description');

        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Home');
        OpenGraph::addProperty('type', 'articles');

        JsonLd::setTitle('Homepage');
        JsonLd::setDescription('This is my page description');

        return view('frontend.homepage', compact('posts', 'categories'));
    }
}
