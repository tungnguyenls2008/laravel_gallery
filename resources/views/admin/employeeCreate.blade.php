@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">
        <form action="{{ route('employees.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Name:</label>
                <div class="col-xs-8">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter member's name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Position:</label>
                <div class="col-xs-8">
                    <input type="text" name="position" value="{{old('position')}}" class="form-control" placeholder="Enter member's position" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Description:</label>
                <div class="col-xs-8">
                    <input type="text" name="text" value="{{old('text')}}" class="form-control" placeholder="Enter description" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Link to Instagram:</label>
                <div class="col-xs-8">
                    <input type="text" name="instagram_link" value="{{old('instagram_link')}}" class="form-control" placeholder="Enter the link to instagram" required>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-xs-2 control-label">Avatar:</label>
                <div class="col-xs-8">
                    <input type="file" class="filestyle" name="images" value="{{old('images')}}" data-placeholder="No avatar chosen yet" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button class="btn btn-primary" type="submit">Save this credential</button>
                </div>
            </div>
        </form>
    </div>
@endsection
