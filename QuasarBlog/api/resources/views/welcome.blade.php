@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h1>Blogs</h1>
        <hr class="py-3">
        @foreach($posts as $post)
            <div class="card my-3">
                <div class="card-header">
                    <h4>
                        <a href="/posts/{{ $post->id }}">
                            {{ $post->title }}
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <h6>{{ $post->body }}</h6>
                        <footer class="blockquote-footer">{{ $post->user->name }} on {{ $post->created_at }}</footer>
                    </blockquote>
                </div>
            </div>
        @endforeach
    </div>
@endsection
