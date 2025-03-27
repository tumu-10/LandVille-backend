@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Blog</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('blogs.index') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="blog_title" class="form-label">Title:</label>
                    <input type="text" name="blog_title" class="form-control" placeholder="">
                    @error('blog_title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="blog_desc" class="form-label">Description:</label>
                    <textarea name="blog_desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                    @error('blog_desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date" class="form-label">Date Written:</label>
                    <input type="text" name="date" class="form-control" placeholder="">
                    @error('date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="blog_author" class="form-label">Author:</label>
                    <input type="text" name="blog_author" class="form-control" placeholder="">
                    @error('blog_author')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for='blog_image' class="form-label">Select Blog Image:</label>
                    <input type="file" name="blog_image" id="blog_image" class="form-control" />
                    @error('blog_image')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Create Blog</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection
