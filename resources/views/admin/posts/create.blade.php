@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('create post') }}</h1>
                    <a href="{{ route('admin.posts.index') }}"
                        class="btn btn-success btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select class="form-control" name="category_id" id="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="title" placeholder="{{ __('Title') }}"
                            name="title" value="{{ old('title') }}" />
                    </div>
                    <div class="form-group">
                        <label for="excerpt">{{ __('Excerpt') }}</label>
                        <textarea name="excerpt" class="form-control" id="excerpt" cols="30" rows="3">{{ old('excerpt') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="banner">{{ __('Banner') }}</label>
                        <input type="file" class="form-control" id="banner" placeholder="{{ __('Banner') }}"
                            name="banner" value="{{ old('banner') }}" />
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                </form>
            </div>
        </div>


        <!-- Content Row -->

    </div>
@endsection

@push('script-alt')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#description'), {
                extraPlugins: [SimpleUploadAdapterPlugin],
                mediaEmbed: {
                    previewsInData: true
                },
            })

            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
