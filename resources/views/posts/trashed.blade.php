@extends('layouts.app');
@section('content')
    <style>
        .table td.table-icons {
            display: flex;
            justify-content: center;
            gap: 3px;
        }
    </style>
    <div class="container">
        <div class="jumbotron mt-3 p-1 text-light bg-dark">
            <div style=" font-size: 30px;font-family: auto;font-style: italic; padding:0 20px;">
                Trashed Posts
                <span style="float: right; margin-top: 10px;">
                    <a class="text-warning" href="{{ route('posts') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512"><path fill="currentColor" fill-rule="evenodd" d="M295.354 26.55c14.07 3.831 21.733 7.023 30.034 13.432l-169.37 197.49c46.017 30.033 94.604 105.47 68.402 166.815c12.76-83.1-72.873-145.107-123.56-153.383L295.354 26.55zM159.848 483.533c31.971 1.3 63.285 1.917 95.871 1.917c70.97 0 139.339-3.194 203.26-9.58c22.987-1.916 42.187-20.455 45.359-44.104c5.13-42.804 7.662-87.548 7.662-133.568c0-46.02-2.532-90.785-7.662-133.59c-3.172-24.285-22.372-42.188-45.359-44.743c-28.141-2.552-56.899-4.49-86.272-6.405c0 0-121.456 263.986-134.24 290.827c-17.901 40.273-42.817 69.667-78.619 79.246zm52.418-93.956c0-81.163-137.355-116.325-184.213-93.953L244.874 43.812c-13.44-3.193-28.777-.638-28.14-.638l-61.983 69.668c-34.978 1.278-68.908 3.831-101.76 7.023c-23.384 2.555-42.431 20.458-45.383 44.744C2.446 207.413 0 252.179 0 298.199c0 46.02 2.446 90.763 7.608 133.567c3.336 26.864 21.8 40.274 45.382 44.105c64.737 10.877 159.276 1.277 159.276-86.294z" clip-rule="evenodd"/></svg>
                    </a>
                </span>
            </div>

        </div>
        @php
            $i = 0;
        @endphp
        {{-- في البداية لا بد من التحقق من وجود أي post ضمن الـ database ويكون ذلك على الشكل التالي : --}}
        @if (count($posts) > 0)
            <table class="table mt-3 table-striped table-dark table-hover ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Author</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Content</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            {{-- طالما أنه يوجد method ضمن الـ post model تكون عائدة على الـ user يمكننا من خلالها الإشارة إلى الـ User Name (حتى لو لم يكن الـ User_id عبارة عن foreign key) --}}
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->created_at->diffForhumans() }}</td>
                            <td>{{ $item->content }}</td>
                            <td>
                                <img src="{{ URL::asset($item->photo) }}" alt="{{ $item->photo }}" class="img-thumbnail"
                                    width="150" height="150" />
                            </td>
                            {{-- Start Edit Icon --}}
                            <td class="table-icons">
                                <a class="text-danger" href="{{ route('post.hdelete', $item->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z"/></svg>
                                </a>
                                <a class="text-success" href="{{ route('post.restore', $item->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6 20v-1h1v1H6m7-12a6 6 0 0 1 6 6a6 6 0 0 1-6 6H9v-1h4a5 5 0 0 0 5-5a5 5 0 0 0-5-5H5.91l3.04 3.04l-.71.7L4 8.5l4.24-4.24l.71.7L5.91 8H13Z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                Empty Trash
            </div>
        @endif
        <div class="container pt-3 text-center">
            {!! $posts->links() !!}
        </div>
    @endsection
