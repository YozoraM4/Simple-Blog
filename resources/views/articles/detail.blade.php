@extends("layouts.app")
@section("content")
    <div class="container">
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        @if($errors->any())
        <div class="alert alert-warning">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    <b class="text-success">{{ $article->user->name }}</b>
                    Category: <b>{{ $article->category->name }}</b>
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $article->body }}</p>
                @auth
                    @can("article-delete", $article)
                        <a class="btn btn-warning" href="{{ url("/articles/delete/$article->id") }}">
                            Delete
                        </a>
                    @endcan
                @endauth
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item active" >
                Comment - {{ count($article->comments) }}
                @foreach($article->comments as $comment)
                    <li class="list-group-item">
                        <b class="text-success">{{ $comment->user->name }}</b>
                        {{ $comment->content }}
                        @can("comment-delete", $comment)
                            <a href="{{url("/comments/delete/$comment->id")}}" class="btn-close float-end"></a>
                        @endcan
                    </li>
                @endforeach
            </li>
        </ul>
        @auth
        <form action="{{ url("/comments/add") }}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2"></textarea>
            <button class="btn btn-primary">Add Comment</button>
        </form>
        @endauth
    </div>
@endsection
