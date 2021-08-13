@extends('layouts.app')

@section('content')
    
<div class="container">

    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">

        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row form-group">
                    <h2 class="pl-3">Edit profile</h2>
                </div>

                <div class="row">
                    <div class="col-8 offset-2"><div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label">Post image</label>
                    </div>
                        <input type="file" class="form-control-file" id="image" name="image">
        
                        @error('image')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
                        value="{{ old('title') ?? $user->profile->title }}" autocomplete="title" autofocus>

                        @error('title')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <input name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" 
                         value="{{ old('description') ?? $user->profile->description }}" autocomplete="description" autofocus>

                        @error('description')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">Url</label>

                    <div class="col-md-6">
                        <input name="url" id="url" type="text" class="form-control @error('url') is-invalid @enderror" 
                         value="{{ old('url')  ?? $user->profile->url }}" autocomplete="url" autofocus>

                        @error('url')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="row pt-4">
            <div class="col-8 offset-2">
                <button type="submit" class="btn btn-primary">
                    Save profile
                </button>
            </div>
            
        </div>
    </form>
    
</div>
@endsection