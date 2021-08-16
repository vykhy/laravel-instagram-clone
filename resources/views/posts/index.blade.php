@extends('layouts.app')

@section('content')

<div class="container">
    @foreach ($posts as $post)
        <div class="row">
            <div class=" mx-auto col-lg-6 col-md-8 col-sm-12 offset-sm-0">
                <a href="/profile/{{ $post->user->id}} "><!--col-6 offset-3 col-md-8 offset-md-2-->
                    <img class="w-100"
                    src="/storage/{{ $post->image }}" alt="">
                </a>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-lg-6 col-md-8 col-sm-12 mx-auto ">
                <p>
                    <span class="font-weight-bold">
                        <a class="text-dark" href="/profile/{{ $post->user->id}}">
                            {{ $post->user->username}}
                        </a>
                    </span>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    @endforeach
    
    <div class="row col-12 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

@endsection