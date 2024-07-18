@extends('frontend.layout')

@section('content')
    <div class="hero overlay inner-page bg-primary py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">{{ isset($category) ? $category->name : "Blog"}}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section search-result-wrap">
        <div class="container">
            <div class="row posts-entry">
                <div class="col-lg-8">
                    @foreach ($posts as $post)
                        <div class="blog-entry d-flex blog-entry-search-item">
                            <a href="{{ route('blog.show', $post->slug) }}" class="img-link me-4">
                                <img src="{{ Storage::url($post->banner)}}" alt="{{ $post->title}}" class="img-fluid" />
                            </a>
                            <div>
                                <span class="date">{{ date_format($post->created_at,'d M Y')}} &bullet; <a href="#">{{ $post->category->name}}</a></span>
                                <h2>
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h2>
                                <p>
                                    {{ $post->excerpt }}
                                </p>
                                <p>
                                    <a href="{{ route('blog.show', $post->category->slug) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <div class="row text-start pt-5 border-top">
                        <div class="col-md-12">
                            {{ $posts->onEachSide(5)->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 sidebar">
                    <div class="sidebar-box search-form-wrap mb-4">
                        <form action="#" class="sidebar-search-form">
                            <span class="bi-search"></span>
                            <input type="text" class="form-control" id="s"
                                placeholder="Type a keyword and hit enter" />
                        </form>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">Latest Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach ($posts_lastests as $last)
                                    
                                <li>
                                    <a href="">
                                        <img src="{{ Storage::url($last->banner)}}" alt="Image placeholder" class="me-4 rounded" />
                                        <div class="text">
                                            <h4>
                                                {{ $last->title }}
                                            </h4>
                                            <div class="post-meta">
                                                <span class="mr-2">{{ date_format($last->created_at,'d M Y')}} </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('blog.category', $category->slug)}}">{{ $category->name }}<span>{{ $category->posts->count()}}</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END sidebar-box -->
                </div>
            </div>
        </div>
    </div>
@endsection
