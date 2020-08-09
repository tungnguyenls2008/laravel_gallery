@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">
        <form action="{{ route('galleries.update', array('gallery'=>$data['id'])) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value={{$data['id']}}>
                <label for="name" class="col-xs-2 control-label">Title:</label>
                <div class="col-xs-8">
                    <input type="text" name="name" value="{{$data['name']}}" class="form-control" placeholder="Enter gallery's title" required>
                </div>
            </div>
            <div class="form-group">
                <label for="old_image" class="col-xs-2 control-label">Cover:</label>
                <div class="col-xs-offset-2 col-xs-10">
                    <img src="/img/gallery/{{ $data['image'] }}" class="img-thumbnail img-responsive" width="150px" >
                    <input type="hidden" name="old_image" value={{$data['image']}}>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-xs-2 control-label">Cover:</label>
                <div class="col-xs-8">
                    <input type="file" class="filestyle" name="image" value="{{old('text')}}" data-placeholder="No cover chosen yet">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button class="btn btn-primary" type="submit">UPDATE THIS GALLERY</button>
                </div>
            </div>
        </form>
    </div>
@endsection
