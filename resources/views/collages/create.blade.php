@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Image</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('collages.index') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('collages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-10">
                    <label for='collage_image' class="form-label">Add Collage Image:</label>
                    <input type="file" name="collage_image" id="collage_image" class="form-control" />
                    @error('collage_image')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Upload Image</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection
