@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Video</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('bg_videos.index') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('bg_videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-10">
                    <label for='video' class="form-label">Select Background Video:</label>
                    <input type="file" name="video" id="video" class="form-control" />
                    @error('video')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Upload New Video Blog</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection
