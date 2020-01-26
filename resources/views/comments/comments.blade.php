<ul class="list-unstyled">
    @foreach($comments as $comment)
        <li class="media mb-3">
            <div class="media-body">
                <div>
                    <span class="text-muted">投稿日：{{ $comment->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($comment->content)) !!}</p>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $comments->links('pagination::bootstrap-4') }}