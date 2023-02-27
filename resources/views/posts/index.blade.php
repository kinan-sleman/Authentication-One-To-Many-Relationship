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
                Last Posts
                <span style="float: right; margin-top: 10px;">
                    <a href="{{ route('post.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                                <path d="M12 8v3m0 0v3m0-3h3m-3 0H9" />
                                <path stroke-linejoin="round"
                                    d="M14 19c3.771 0 5.657 0 6.828-1.172C22 16.657 22 14.771 22 11c0-3.771 0-5.657-1.172-6.828C19.657 3 17.771 3 14 3h-4C6.229 3 4.343 3 3.172 4.172C2 5.343 2 7.229 2 11c0 3.771 0 5.657 1.172 6.828c.653.654 1.528.943 2.828 1.07" />
                                <path
                                    d="M14 19c-1.236 0-2.598.5-3.841 1.145c-1.998 1.037-2.997 1.556-3.489 1.225c-.492-.33-.399-1.355-.212-3.404L6.5 17.5" />
                            </g>
                        </svg></a>
                </span>
                <span style="float: right; margin-top: 10px; margin-right: 10px;">
                    <a class="text-danger" href="{{route('posts.trashed')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M21.03 3L18 20.31c-.17.96-1 1.69-2 1.69H8c-1 0-1.83-.73-2-1.69L2.97 3h18.06M5.36 5L8 20h8l2.64-15H5.36M9 18v-4h4v4H9m4-4.82L9.82 10L13 6.82L16.18 10L13 13.18Z"/></svg>
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
                                    width="300" height="300" />
                            </td>
                            {{-- Start Edit Icon --}}
                            <td class="table-icons">
                                <a class="text-primary" href="{{ route('post.edit', $item->id ) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 22q-.825 0-1.413-.588T3 20V6q0-.825.588-1.413T5 4h1V3q0-.425.288-.713T7 2q.425 0 .713.288T8 3v1h8V3q0-.425.288-.713T17 2q.425 0 .713.288T18 3v1h1q.825 0 1.413.588T21 6v6h-2v-2H5v10h7v2H5Zm17.125-5L20 14.875l.725-.725q.275-.275.7-.275t.7.275l.725.725q.275.275.275.7t-.275.7l-.725.725ZM14 22.5v-1.2q0-.2.075-.388t.225-.337l5-5l2.125 2.125l-5 5q-.15.15-.338.225T15.7 23h-1.2q-.2 0-.35-.15T14 22.5Z"/></svg>
                                </a>
                                <a class="text-danger" href="{{route('post.destroy',$item->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z"/></svg>
                                </a>
                                <a class="text-success" href="{{route('post.show',$item->slug)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                There isn't any post yet
            </div>
        @endif
        <div class="container pt-3 text-center">
            {!! $posts->links() !!}
        </div>
    @endsection
