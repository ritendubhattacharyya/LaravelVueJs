@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">{{ $post->title }}</h1>
                <p class="lead">{{ $post->body }}</p>
                <footer class="blockquote-footer">{{ $post->user->name }} on {{ $post->created_at }}</footer>
            </div>
        </div>
        <div class="input-group my-3">
            <form action="/comments/{{ $post->id }}" method="post" class="d-flex w-100">
                @csrf
                <input
                    type="text"
                    class="form-control w-85"
                    placeholder="Comment..."
                    aria-label="Recipient's username"
                    aria-describedby="button-addon2"
                    name="comment">
                <div class="input-group-append d-inline">
                        <button class="btn btn-outline-secondary w-15" type="submit" id="button-addon2">Comment</button>
                </div>
            </form>
        </div>
        <h3 class="pt-4">Comments</h3>
        <hr class="pb-4">
        @forelse($comments as $comment)
            <div class="card my-2">
                <div class="card-header">
                    {{ $comment->user->name }}
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $comment->comment }}</p>
                        <footer class="blockquote-footer">{{ $comment->created_at }}</footer>
                    </blockquote>
                    @can('deleteComment', $comment->user)
                        <form action="/comments/{{ $comment->id }}/delete" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>No Comments</p>
                    </blockquote>
                </div>
            </div>
        @endforelse
    </div>
@endsection
