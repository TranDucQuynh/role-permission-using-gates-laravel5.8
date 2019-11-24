@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Post</div>

                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('update_post', ['post'=>$post->id]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">Title</label>

                                <div class="col-md-9">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title',$post->title) }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-2 col-form-label text-md-right">Body</label>

                                <div class="col-md-9">
                                    <textarea name="body" id="body" cols="30" rows="10" class="form-control" required autocomplete="body" autofocus>{{ old('body',$post->body) }}</textarea>
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-9 offset-md-2">
                                    <button type="submit" class="btn btn-outline-success">
                                        {{ __('Update') }}
                                    </button>
                                    @can('publish-post')
                                        <a href="{{ route('publish_post', ['post' => $post->id]) }}" class="btn btn-outline-primary">
                                            {{ __('Publish') }}
                                        </a>
                                    @endcan
                                    <a href="{{ route('list_posts') }}" class="btn btn-outline-primary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
