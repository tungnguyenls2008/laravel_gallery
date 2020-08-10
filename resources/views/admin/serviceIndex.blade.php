@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div style="margin:0px 50px 0px 50px;">
        @if($services)
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $k => $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td><a href="{{ route('services.edit', ['service'=>$service->id]) }}" alt="{{$service->name}}">{{$service->name}}</a></td>
                        <td>{{ $service->text }}</td>
                        <td>{{ $service->icon }} <i class="fa {{ $service->icon }}"></i></td>
                        <td>
                            <form action="{{route('services.destroy', ['service'=>$service->id])}}" class="form-horizontal" method="POST">
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
        <a href="{{ route('services.create') }}" class="btn btn-primary">Create new Service</a>
    </div>
    <br><br>
@endsection
