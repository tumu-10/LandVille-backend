@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Service</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('services.index') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="services_title" class="form-label">Title:</label>
                    <input type="text" name="services_title" class="form-control" placeholder="Name of the Property">
                    @error('services_title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="services_desc" class="form-label">Description:</label>
                    <textarea name="services_desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                    @error('services_desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sub_services">Sub Services</label>
                    <input type="text" name="sub_services[]" class="form-control" placeholder="Enter sub-service" value="{{ old('sub_services.0') }}" required>
                    <button type="button" onclick="addSubService()">Add More</button>
                    <div id="subServicesContainer"></div>
                    @error('sub_services')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                 </div>
                <div class="col-md-10">
                    <label for='services_img' class="form-label">Select Cover Picture:</label>
                    <input type="file" name="services_img" id="services_img" class="form-control" />
                    @error('services_img')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for='video' class="form-label">Select video:</label>
                    <input type="file" name="video" id="video" class="form-control" />
                    @error('video')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Create Service</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

    <script>
        function addSubService() {
            const container = document.getElementById('subServicesContainer');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'sub_services[]';
            input.classList.add('form-control');
            container.appendChild(input);
        }
    </script>

@endsection
