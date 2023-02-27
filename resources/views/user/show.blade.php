@extends('layouts.app')

@section('content')
    <div class="container pt-5  ">
        @if ($message = Session::get('success'))
            <div class="pt-3 pb-3 alert alert-success text-center" role="alert">
                {{ $message }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center " style="font-size: 27px;font-style: italic;">
                        Welcome {{ $user->name }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5 class="text-primary">Name : <span class="text-dark"> {{ $user->name }} </span></h1>
                            <h5 class="text-primary">Email : <span class="text-dark"> {{ $user->email }} </span></h1>
                            <h5 class="text-primary">gender : <span class="text-dark"> {{$user->profile->gender}} </span></h1>
                            <h5 class="text-primary">province : <span class="text-dark">{{$user->profile->province}}</span></h1>
                            <h5 class="text-primary">Bio : <span class="text-dark">{{$user->profile->bio}}</span></h1>
                            <h5 class="text-primary">facebook URL : <span class="text-dark">{{$user->profile->facebook}}</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
