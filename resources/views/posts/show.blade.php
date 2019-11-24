@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $post->title }}
                        <a href="{{ route('list_posts') }}" class="btn btn-outline-danger">{{ __('Return') }}</a>
                    </div>

                    <div class="card-body">
                        {{ $post->body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
