@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card" style=" margin-bottom:13px;">
                    <div class="card-body " style="text-align:center; background-color:#eee; color:#777; font-size:20px;">
                        Edit post
                    </div>
                </div>
            </div>
        </div>
        @if (count($errors) > 0){
            @foreach ($errors->all() as $item)
            <div class="alert alert-danger">
                {{$item}}
            </div>
            @endforeach
        }
        @endif
        <div class="row">

            <div class="col">
                <form action="{{ route('post.update',['id'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input required type="text" class="form-control" value="{{$post->title}}" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">content</label>
                        <textarea  required class="form-control" name="content" rows="3">{!!$post->content!!}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">photo</label>
                        <input type="file" class="form-control" value="{{$post->photo}}" name="photo">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success" type="submit">
                            Update
                        </button>
                        <a href="{{route('posts')}}" class="btn btn-warning" type="button">
                            Return
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
