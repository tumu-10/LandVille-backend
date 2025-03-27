@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('blogs.create') }}"> Create Blog</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Blogs</div>
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
                                <th class="wd-15p border-bottom-0">title</th>
                                <th class="wd-15p border-bottom-0">Desc</th>
                                <th class="wd-15p border-bottom-0">Author</th>
                                <th class="wd-15p border-bottom-0">Uploaded On</th>
                                <th class="wd-15p border-bottom-0">cover image</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $opportunity)
                            <tr>
                                <td>{{$opportunity->id}}</td>
                                <td>{!! nl2br(wordwrap($opportunity->blog_title, 20, "\n", true)) !!}</td>
                                <td>{{ \Illuminate\Support\Str::limit($opportunity->blog_desc, 20, '...') }}</td>
                                <td>{{$opportunity->blog_author}}</td>
                                <td>{{$opportunity->date}}</td>
                                <td>
                                @if(!empty($opportunity->blog_img) && is_string($opportunity->blog_img))
                                    <img src="{{ asset('storage/' . $opportunity->blog_img) }}" alt="Image" width="200" height="200">
                                @endif
                                </td>
                                <td>{{$opportunity->created_at}}</td>
                                <td>
                                        <form action="{{ route('blogs.destroy', $opportunity->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this blog?')">
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
