@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">
        <form action="{{ route('employees.update', array('employee'=>$data['id'])) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value={{$data['id']}}>
                <label for="name" class="col-xs-2 control-label">Name:</label>
                <div class="col-xs-8">
                    <input type="text" name="name" value="{{$data['name']}}" class="form-control" placeholder="Enter member's name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Position:</label>
                <div class="col-xs-8">
                    <input type="text" name="position" value="{{$data['position']}}" class="form-control" placeholder="Enter member's position" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Description:</label>
                <div class="col-xs-8">
                    <input type="text" name="text" value="{{$data['text']}}" class="form-control" placeholder="Enter description" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Link to Instagram:</label>
                <div class="col-xs-8">
                    <input type="text" name="instagram_link" value="{{$data['instagram_link']}}" class="form-control" placeholder="Enter the link to instagram" required>
                </div>
            </div>
            <div class="form-group">
                <label for="old_images" class="col-xs-2 control-label">Avatar:</label>
                <div class="col-xs-offset-2 col-xs-10">
                    <img src="/img/gallery/{{ $data['images'] }}" class="img-thumbnail img-responsive" width="150px" >
                    <input type="hidden" name="old_images" value={{$data['images']}}>
                </div>
            </div>
            <div class="form-group">
                <label for="images" class="col-xs-2 control-label">Avatar:</label>
                <div class="col-xs-8">
                    <input type="file" class="filestyle" name="images" value="{{old('text')}}" data-placeholder="No avatar chosen yet">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
