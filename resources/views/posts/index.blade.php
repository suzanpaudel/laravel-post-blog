@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('posts') }}" method="post" class="p-4 mt-4" style="background: #fff">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') border border-danger @enderror"
                            placeholder="Your Post Title" name="title" id="title">
                        @error('title')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Post</label>
                        <textarea name="body" id="body" rows="5"
                            class="form-control @error('body') border border-danger @enderror"
                            placeholder="Your Post Body..."></textarea>
                        @error('body')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <h1>Posts</h1>
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <div class="row m-1 p-3" style="background: #eee">
                            <div class="col-12">
                                <h3>{{ $post->title }}</h3>
                                <h5 style="display: inline-block">{{ $post->user->name }}</h6> <span
                                        class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                                    <p class="lead">{{ $post->body }}</p>
                                    <div class="d-flex">
                                        @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link">Delete</button>
                                            </form>
                                        @endcan
                                        @auth
                                            @if ($post->likedBy(auth()->user()))
                                                <form action="{{ route('posts.likes', $post->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link">Unlike</button>
                                                </form>
                                            @else
                                                <form action="{{ route('posts.likes', $post->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-link">Like</button>
                                                </form>
                                            @endif

                                        @endauth

                                        <button class="btn btn-link btn-disabled">
                                            {{ $post->likes->count() }}
                                            {{ Str::plural('like', $post->likes->count()) }}

                                        </button>
                                    </div>
                            </div>

                        </div>
                    @endforeach
                    {{-- {{ $posts->links() }} --}}


                @else
                    <p class="lead">There are no posts available!</p>
                @endif
            </div>
        </div>
    </div>
@endsection
