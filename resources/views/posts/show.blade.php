@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-8">
                <img class="w-100"
                src="/storage/{{ $post->image }}" alt="">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img class="rounded-circle w-100 " 
                        src="{{ $post->user->profile->profileImage() }}" 
                        style="max-width:60px"
                        alt="">
                    </div>
                    <div>
                       <h5>
                            <a class="text-dark" href="/profile/{{ $post->user->id}}">
                                {{ $post->user->username}}
                            </a>
                            <a class="pl-3 font-weight-bold font-size-base" href="" >Follow </a>
                        </h5> 
                    </div>
                    
                </div>
                <hr>
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
    </div>
</div>

@endsection