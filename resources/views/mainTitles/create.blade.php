@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add main_titles</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('mainTitles.index') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('mainTitles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="word1" class="form-label">WORD ONE:</label>
                    <input type="text" name="word1" class="form-control" placeholder="Name of the Property">
                    @error('word1')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="word2" class="form-label">WORD TWO:</label>
                    <textarea name="word2" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                    @error('word2')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Add New Titles</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection
