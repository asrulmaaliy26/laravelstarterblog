<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta; 

class BlogController extends Controller
{
    public function index(Request $request){
        
        $posts = Post::with('category');
        if($q = $request->query('search')){
            $q = str_replace('-', ' ', Str::slug($q));
            $posts = $posts->whereRaw('MATCH(title, excerpt, description) AGAINST(? IN NATURAL LANGUAGE MODE)', [$q]);
        }

        $posts = $posts->paginate(5);

        $posts_lastests = Post::with('category')->latest()->get();
        $categories = Category::with('posts')->get();
        return view('frontend.blog.index' , compact('posts', 'posts_lastests', 'categories', 'q'));
    }
    public function show(Post $post){
        $posts_lastests = Post::with('category')->latest()->get();
        $categories = Category::with('posts')->get();
        
        return view('frontend.blog.single' , compact('post', 'posts_lastests', 'categories'));
        // print_r($post);
    }

    public function category(Category $category){
       $posts = Post::where('category_id', $category->id)->paginate(3);
       $posts_lastests = Post::with('category')->latest()->get();
       $categories = Category::with('posts')->get();
       
       return view('frontend.blog.index', compact('posts', 'posts_lastests', 'categories', 'category'));
    }
}
