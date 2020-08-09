@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">
        <form action="{{ route('services.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">Name:</label>
                <div class="col-xs-8">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter service's name here" required>
                </div>
            </div>
            <div class="form-group">
                <label for="icon" class="col-xs-2 control-label">Service's Icon:</label>
                <div class="col-xs-8">
                    <input type="text" name="icon" value="{{old('icon')}}" class="form-control" placeholder="Enter service's Icon" required>
                </div>
            </div>
            <div class="form-group">
                <label for="text" class="col-xs-2 control-label">Description:</label>
                <div class="col-xs-8">
                    <textarea name="text"  id="editor" class="form-control" placeholder="Enter service's description" required>{{old('text')}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button class="btn btn-primary" type="submit">CREATE THIS SERVICE</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
@endsection
