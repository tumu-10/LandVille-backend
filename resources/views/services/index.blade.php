@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('services.create') }}"> Create Service</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All LandVille Services</div>
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
                                <th class="wd-15p border-bottom-0">TITLE</th>

                                <th class="wd-15p border-bottom-0">SUB-SERVICE</th>
                                <th class="wd-20p border-bottom-0">IMAGES</th>
                                <th class="wd-20p border-bottom-0">video</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th class="wd-15p border-bottom-0">DESC</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->services_title}}</td>
                                <td>
                                    @if(is_array($post->sub_services))
                                        {{ implode(', ', $post->sub_services) }}
                                    @endif
                                </td>
                                <td>
                                @if(!empty($post->services_img) && is_string($post->services_img))
                                    <img src="{{ asset('storage/' . $post->services_img) }}" alt="Image" width="100" height="100">
                                @endif
                                </td>
                                <td>
                                @if(!empty($post->services_video) && is_string($post->services_video))
                                        <video class="embed-responsive-item" controls width="300" height="100">
                                            <source class="embed-responsive-item" src="{{ asset('storage/' . $post->services_video) }}"
                                                allowfullscreen autoplay="0">
                                        </video>

                                @endif
                                </td>
                                <td>{{$post->created_at}}</td>
                                <td>{{ \Illuminate\Support\Str::limit($post->services_desc, 20, '...') }}</td>


                                <td>
                                        <form action="{{ route('services.destroy', $post->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this service?')">
                                                Delete
                                            </button>
                                        </form>
                                </td>                            </tr>
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
