@extends('frontend.layout')

@section('content')
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">Latest Posts</h2>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <a href="category.html" class="read-more">View All</a>
                </div>
            </div>

            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 mb-4">
                        <div class="post-entry-alt">
                            <a href="" class="img-link"><img
                                    src="{{ Storage::url($post->banner) }}" alt="Image"
                                    class="img-fluid" /></a>
                            <div class="excerpt">
                                <h2>
                                    <a href="{{ route('blog.show', $post->slug)}}">{{ $post->title }}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @foreach ($categories as $category)
        
    <section class="section posts-entry posts-entry-sm bg-light">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">{{ $category->name }}</h2>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <a href="{{ route('blog.category',$category->slug)}}" class="read-more">View All</a>
                </div>
            </div>
            <div class="row">
                @foreach ($category->posts as $post)
                    
                <div class="col-md-6 col-lg-3">
                    <div class="blog-entry">
                        <a href="{{ route('blog.show', $post->slug)}}" class="img-link">
                            <img src="{{ Storage::url($post->banner) }}" alt="Image" class="img-fluid" />
                        </a>
                        <h2>
                            <a href="{{ route('blog.show', $post->slug)}}">{{ $post->title }}</a>
                        </h2>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endforeach
@endsection
