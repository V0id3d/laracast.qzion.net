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
    </div>
@endsection