<div class="panel panel-default">
    <div class="panel-heading"><a href="#">{{ $reply->owner->name }}</a> responded {{ $reply->created_at->diffForHumans() }}</div>
    <div class="panel-body">
        <p>{{ $reply->body }}</p>
    </div>
</div>