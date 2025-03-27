@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add testimonials</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('testimonials.index') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Name of testifier:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name of the Property">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="desc" class="form-label">Message:</label>
                    <textarea name="desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                    @error('desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-10">
                    <label for='avatar' class="form-label">Select a Picture:</label>
                    <input type="file" name="avatar" id="avatar" class="form-control" />
                    @error('avatar')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Create testimonial</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection
