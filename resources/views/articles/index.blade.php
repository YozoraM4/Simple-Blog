@extends("layouts.app")
@section("content")
    <div class="container">
        <h1>Article List</h1>
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        {{ $articles->links() }}
        @foreach ($articles as $article)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }},
                    <b class="text-success">{{ $article->user->name }}</b>
                    Category: <b>{{ $article->category->name }}</b>,
                    Comments: <b>{{ count($article->comments) }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a class="card-link" href="{{ url("/articles/detail/$article->id") }}">
                    View Detail &raquo;
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
