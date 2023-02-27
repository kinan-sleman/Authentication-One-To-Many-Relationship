 @extends('layouts.app')

 @section('content')
     @php
         $GenderArray = ['Male', 'Female'];
     @endphp

     <div class="container pt-5">
         <form method="POST" action="{{ route('profile.update') }}">
             @csrf
             @method('PUT')
             @if (count($errors) > 0)
                 @foreach ($errors as $item)
                     <div class="alert alert-danger" role="alert">
                         {{ $item }}
                     </div>
                 @endforeach
             @endif
             @if ($message = Session::get('success'))
                 <div class="pt-3 pb-3 alert alert-success text-center" role="alert">
                     {{ $message }}
                 </div>
             @endif
             <div class="mb-3">
                 <label for="exampleFormControlInput1" class="form-label">Name</label>
                 <input  type="text" name="name" value="{{ $user->name }}" class="form-control">
             </div>
             <div class="mb-3">
                 <label for="exampleFormControlInput1" class="form-label">Password</label>
                 <input   type="password" class="form-control" name="password">
             </div>
             <div class="mb-3">
                 <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                 <input  type="password" class="form-control" name="c_password">
             </div>
             <div class="mb-3">
                 <label for="exampleFormControlInput1" class="form-label">province</label>
                 <input type="text" required  name="province" value="{{ $user->profile->province }}" class="form-control">
             </div>
             <select name="gender"  required class="form-control ">
                 @foreach ($GenderArray as $item)
                     <option value="{{ $item }}"{{$user->profile->gender == $item ? 'selected' : '' }}>
                         {{ $item }}</option>
                 @endforeach
             </select>
             <div class="mb-3">
                 <label for="exampleFormControlInput1" class="form-label">facebook URL</label>
                 <input name="facebook" type="text" value="{{ $user->profile->facebook }}" class="form-control">
             </div>
             <div class="mb-3">
                 <label for="exampleFormControlTextarea1" class="form-label">BIO</label>
                 <textarea  required name="bio" class="form-control" rows="3">
                    {!! $user->profile->bio !!}
                 </textarea>
             </div>
             <div class="mb-3">
                 <button class="btn btn-success " type="submit"> Update </button>
             </div>
         </form>
     </div>
 @endsection
