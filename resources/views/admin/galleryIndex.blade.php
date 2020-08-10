@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div style="margin:0px 50px 0px 50px;">
        @if($galleries)
            <br><br>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Title</th>
                    <th>Artwork</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($galleries as $k => $gallery)
                    <tr>
                        <td>{{ $gallery->id }}</td>
                        <td><a href="{{ route('galleries.edit', ['gallery'=>$gallery->id]) }}" alt="{{$gallery->name}}">{{$gallery->name}}</a></td>
                        <td><img src="/img/gallery/{{ $gallery->image }}" class="img-thumbnail img-responsive" width="75px"></td>
                        <td>
                            <form action="{{route('galleries.destroy', ['gallery'=>$gallery->id])}}" class="form-horizontal" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if ($galleries->total() > $galleries->count())
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{$galleries->links()}}
                    </ul>
                </nav>
            @endif
        @endif
            <a href="{{ route('galleries.create') }}" class="btn btn-primary">Create new Gallery</a>

    </div>
@endsection
