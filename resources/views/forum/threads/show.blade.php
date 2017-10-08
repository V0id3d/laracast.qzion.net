@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="#">{{ $thread->owner->name }}</a> posted: {{ $thread->title }} {{ $thread->created_at->diffForHumans() }}</div>

                    <div class="panel-body">
                        <p>{{ $thread->body }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include ('forum.threads.partials._reply')
                @endforeach
            </div>
        </div>

        @if (auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection