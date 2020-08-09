@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">
        <form action="{{ route('portfolios.update', array('portfolio'=>$data['id'])) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value={{$data['id']}}>
                <label for="name" class="col-xs-2 control-label">Title:</label>
                <div class="col-xs-8">
                    <input type="text" name="name" value="{{$data['name']}}" class="form-control" placeholder="Enter portfolio's title here" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Tag:</label>
                <div class="col-xs-8">
                    <input type="text" name="filter" value="{{$data['filter']}}" class="form-control" placeholder="Enter tag here" required>
                </div>
            </div>
            <div class="form-group">
                <label for="old_images" class="col-xs-2 control-label">Cover:</label>
                <div class="col-xs-offset-2 col-xs-10">
                    <img src="/img/{{ $data['images'] }}" class="img-thumbnail img-responsive" width="150px" >
                    <input type="hidden" name="old_images" value={{$data['images']}}>
                </div>
            </div>

            <div class="form-group">
                <label for="images" class="col-xs-2 control-label">Cover:</label>
                <div class="col-xs-8">
                    <input type="file" class="filestyle" name="images" value="{{old('text')}}" data-placeholder="No cover chosen yet">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button class="btn btn-primary" type="submit">UPDATE THIS PORTFOLIO</button>
                </div>
            </div>
        </form>
    </div>
@endsection
