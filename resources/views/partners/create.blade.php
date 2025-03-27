
@extends('layouts.master')

@section('content')


    <!-- End Row-->
    
        <div class="col-lg-12">>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Post</h4>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('index.posts') }}"> Back</a>
                </div>
                @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('store.posts') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Property Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Name of the Property">
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <span class="form-label">Select Category of the Property:</span>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="desc" class="form-label">Brief Description of the Property:</label>
                            <textarea name="desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                            @error('desc')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Selling Price:</label>
                            <input type="text" name="price" class="form-control" placeholder="Eg UGX 500,000 OR $2000">
                            @error('price')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location" class="form-label">Exact Location of the place:</label>
                            <input type="text" name="location" class="form-control" placeholder="Location of the Property">
                            @error('location')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bedroom" class="form-label">How many bedrooms does it have?:</label>
                            <input type="text" name="bedroom" class="form-control" placeholder="Insert only the number">
                            @error('bedroom')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bathroom" class="form-label">How many bathrooms does it have?:</label>
                            <input type="text" name="bathroom" class="form-control" placeholder="Insert only the number">
                            @error('bathroom')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="owner" class="form-label"> Whats the name of the Landlord?:</label>
                            <input type="text" name="owner" class="form-control" placeholder="">
                            @error('owner')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact" class="form-label"> Whats the contact of the Landlord?:</label>
                            <input type="text" name="contact" class="form-control" placeholder="">
                            @error('contact')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="size" class="form-label">Incase its land, give the Size of the Property (Use Acres, Hectares or Decimals):</label>
                            <input type="text" name="size" class="form-control" placeholder="Size of the Property">
                            @error('size')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">What do you want to do with the Property? (For now, leave it as Rental)</label>
                            <select name="status" id="status" class="form-control">
                                <option value="rental" {{ $post->status == 'rental' ? 'selected' : '' }}>Rental</option>
                                <option value="for sale" {{ $post->status == 'for sale' ? 'selected' : '' }}>For Sale</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-10">
                                    <label for="images" class="form-label">Upload atleast Four Images of the Property:</label>
                                    <input type="file" name="images[]" id="images" multiple="multiple" class="form-control">
                                    @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                        </div>
                        <div class="col-md-10">
                                    <label for= 'profile_pic' class="form-label">Select Profile Picture:</label>
                                <input type="file" name="profile_pic" id="profile_pic" class="form-control"/>
                                    @error('profile_pic')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                        </div>
                        <div class="col-md-10">
                                    <label for= 'video' class="form-label">Select Video:</label>
                                <input type="file" name="video" id="video" class="form-control"/>
                                    @error('video')
                                    <div class="alert alert-danger mt-1 mb-0">{{ $message }}</div>
                                    @enderror
                        </div>

                
                        <button type="submit" class="btn btn-primary mt-1 mb-0">Create Post</button>

                    </form>
                </div>
            </div>
        </div>
    
    <!-- End Row -->

    @endsection
