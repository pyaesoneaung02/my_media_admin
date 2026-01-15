@extends('admin.layouts.app')

@section('content')
<div class="mt-5 col-6 offset-3">

    <i class="fa-solid fa-arrow-left text-dark"
       style="font-size: 28px; cursor: pointer;"
       onclick="history.back()"></i>

    <div class="card-header">
        <div class="text-center">
            <img class="rounded shadow-sm" width="400px"
            @if ($post['image'] == null)
            src="{{asset('defaultImage/photo.jpg')}}"
            @else
            src="{{asset('postImage/'. $post['image'])}}"
            @endif>
        </div>
    </div>
    <div class="card-body">
        <h3 class="text-center">{{ $post->title }}</h3>
        <p class="text-start">{{ $post->description }}</p>
    </div>

  </div>
@endsection
