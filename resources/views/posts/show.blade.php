@extends('layouts.app')
@section('content')
    <style>
        .row {
            align-items: center;
        }
    </style>
    <div class="card mb-3" style="max-width: 1040px; margin: 60px auto">
        <div class="row g-0">
            <div class="col-md-4">
                <img class="img-fluid img-thumbnail" src="{{URL::asset($post->photo)}}" class="img-fluid rounded-start" alt="{{URL::asset($post->photo)}}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text lead">{{$post->content}}</p>
                    <p class="lead text-secondary">
                        Created At : {{$post->created_at->diffForhumans()}} <br/>
                        Updated At : {{$post->updated_at->diffForhumans()}}
                        {{-- من خلال الـ diffForHumans Method يتم تعيين الـ Date على شكل Days & Hours & ... ETC --}}
                    </p>
                    <a href="{{route('posts')}}" class="btn btn-warning">Return</a>
                </div>
            </div>
        </div>
    </div>
@endsection
