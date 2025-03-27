@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Image</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('service_img.index') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('service_img.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-10">
                    <label for='service_image' class="form-label">Add Service Image:</label>
                    <input type="file" name="service_image" id="service_image" class="form-control" />
                    @error('img')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Upload Service Image</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection
