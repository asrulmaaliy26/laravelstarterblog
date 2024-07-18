@extends('frontend.layout')

@section('content')
<div class="hero overlay inner-page bg-primary py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center pt-5">
            <div class="col-lg-6">
                <h1 class="heading text-white mb-3" data-aos="fade-up">{{ $post->title }}</h1>
                <p class="text-white">
                    {{ $post->created_at ? $post->created_at->format('d M Y') : 'N/A' }} 
                    &bullet; 
                    @if($post->category)
                        <a href="{{ route('blog.category', $post->category->slug) }}" class="text-white">{{ $post->category->name }}</a>
                    @else
                        <span class="text-white">Uncategorized</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<div class="section search-result-wrap">
    <div class="container">
        <div class="row posts-entry">
            <div class="col-lg-8">
                <div class="blog-entry single-entry">
                    <img src="{{ Storage::url($post->banner) }}" alt="{{ $post->title }}" class="img-fluid mb-5">
                    <div class="post-meta d-flex align-items-center mb-4">
                        <div class="author-pic">
                            <img src="{{ asset('path/to/author-image.jpg') }}" alt="Image" class="img-fluid">
                        </div>
                        <div class="text">
                            <span class="date">{{ $post->created_at ? $post->created_at->format('d M Y') : 'N/A' }}</span>
                        </div>
                    </div>
                    <h2 class="mb-4">{{ $post->title }}</h2>
                    <p>{{ $post->description }}</p>
                </div>

                <div class="pt-5">
                    <h3 class="mb-5">Categories</h3>
                    <div class="tagcloud">
                        @foreach ($categories as $category)
                        <a href="{{ route('blog.category', $category->slug) }}" class="tag-cloud-link">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4 sidebar">
                <div class="sidebar-box">
                    <div class="bio text-center">
                        <img src="{{ asset('path/to/author-image.jpg') }}" alt="Image" class="img-fluid mb-4 w-50 rounded-circle">
                    </div>
                </div>
                <div class="sidebar-box">
                    <h3 class="heading">Latest Posts</h3>
                    <div class="post-entry-sidebar">
                        <ul>
                            @foreach ($posts_lastests as $last)
                            <li>
                                <a href="{{ route('blog.show', $last->slug) }}">
                                    <img src="{{ Storage::url($last->banner)}}" alt="Image placeholder" class="me-4 rounded">
                                    <div class="text">
                                        <h4>{{ $last->title }}</h4>
                                        <div class="post-meta">
                                            <span class="mr-2">{{ $last->created_at ? $last->created_at->format('d M Y') : 'N/A' }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="sidebar-box">
                    <h3 class="heading">Categories</h3>
                    <ul class="categories">
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}<span>{{ $category->posts->count() }}</span></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
