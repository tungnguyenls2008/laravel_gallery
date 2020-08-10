@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div style="margin:0px 50px 0px 50px;">
        @if($portfolios)
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th>Cover</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($portfolios as $k => $portfolio)
                    <tr>
                        <td>{{ $portfolio->id }}</td>
                        <td><a href="{{ route('portfolios.edit', ['portfolio'=>$portfolio->id]) }}" alt="{{$portfolio->name}}">{{$portfolio->name}}</a></td>
                        <td>{{ $portfolio->filter }}</td>
                        <td><img src="/img/{{ $portfolio->images }}" class="img-thumbnail img-responsive" width="75px"></td>
                        <td>
                            <form action="{{route('portfolios.destroy', ['portfolio'=>$portfolio->id])}}" class="form-horizontal" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
            <a href="{{ route('portfolios.create') }}" class="btn btn-primary">Create new Portfolio</a>
    </div>
    <br><br>
@endsection
