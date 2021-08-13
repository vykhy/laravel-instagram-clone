@extends('layouts.app')

@section('content')
    
<div class="container">

    <form action="/p" enctype="multipart/form-data" method="post">

        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row form-group">
                    <h2 class="pl-3">Add new post</h2>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label text-md-right">Post caption</label>

                    <div class="col-md-6">
                        <input name="caption" id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" required caption="name" value="{{ old('caption') }}" autocomplete="caption" autofocus>

                        @error('caption')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-8 offset-2"><div class="form-group row">
                <label for="image" class="col-md-4 col-form-label">Post image</label>
            </div>
                <input type="file" class="form-control-file" id="image" required name="image">

                @error('image')
                    <strong>{{ $message }}</strong>
                @enderror
            </div>
            
        </div>

        <div class="row pt-4">
            <div class="col-8 offset-2">
                <button type="submit" class="btn btn-primary">
                    Add new post
                </button>
            </div>
            
        </div>
    </form>
    
</div>
@endsection