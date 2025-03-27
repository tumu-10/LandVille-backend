@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('bg_videos.create') }}"> Add New Video Blog</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Background Video</div>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true"></button>
                    {{Session::get('message')}}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="wd-15p border-bottom-0">Background Video</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bgVideos as $opportunity)
                            <tr>
                                <td>{{$opportunity->id}}</td>
                                <td>
                                    @if (is_string($opportunity->video_path))
                                        <video class="embed-responsive-item" controls width="200" height="200">
                                            <source class="embed-responsive-item" src="{{ asset('storage/' . $opportunity->video_path) }}"
                                                allowfullscreen autoplay="0">
                                        </video>
                                    @endif
                                </td>
                                <td>{{$opportunity->created_at}}</td>
                                <td>
                                <form action="{{ route('bg_videos.destroy', $opportunity->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this video?')">
                                        Delete
                                    </button>
                                </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- End Row -->
    <!--End Page header-->

    @endsection
