@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lists Post
                        @can('create-post')
                            <a class="pull-right btn btn-sm btn-primary float-right" href="{{ route('create_post') }}">New</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div class="row">
                                @foreach($posts as $post)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <h3><a href="{{ route('edit_post', ['id' => $post->id]) }}">{{ $post->title }}</a></h3>
                                                <p>{{ \Str::limit($post->body, 50) }}</p>
                                                @can('update-post', $post)
                                                    <a href="{{ route('edit_post', ['id' => $post->id]) }}" class="btn btn-sm btn-outline-warning" role="button">Edit</a>
                                                @endcan
                                                @can('delete-post')
                                                    <form action="{{ route('delete_post', ['id' => $post->id]) }}" method="post">@csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
