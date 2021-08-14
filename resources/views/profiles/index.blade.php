@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img class="rounded-circle w-100" src="/storage/{{ $user->profile->image }}" alt="">
        </div>
        <div class="col-9 pl-4 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
            </div>
            @can('update', $user->profile)
                <a class="pr-4" href="/p/create"> Add new post</a>

                <a href="/profile/{{ $user->id }}/edit"> Edit profile</a>
            @endcan

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }} </strong> posts</div>
                <div class="pr-5"><strong>300k</strong> followers</div>
                <div class="pr-5"><strong>212</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">
                {{ $user->profile->title }}
            </div>
            <div>
                {{ $user->profile->description }}
            </div>
            <div><a href="#"> {{ $user->profile->url }} </a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-5">
            <a href="/p/{{ $post->id }}">
                <img class="w-100" src="/storage/{{ $post->image }}"alt="">
            </a>
             
        </div>
        @endforeach
    </div>

    
</div>
@endsection
