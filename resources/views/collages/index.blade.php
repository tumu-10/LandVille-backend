@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">Collage</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('collages.create') }}"> Add new image</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Collage Image</div>
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
                                <th class="wd-15p border-bottom-0">cover image</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collages as $opportunity)
                            <tr>
                                <td>{{$opportunity->id}}</td>
                                <td>
                                @if(!empty($opportunity->image) && is_string($opportunity->image))
                                    <img src="{{ asset('storage/' . $opportunity->image) }}" alt="Image" width="200" height="200">
                                @endif
                                </td>
                                <td>{{$opportunity->created_at}}</td>
                                <td>
                                        <form action="{{ route('collages.destroy', $opportunity->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this image?')">
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
