@extends('layouts.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">

        <form action="{{ route('services.update', array('service'=>$data['id'])) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
            <div class="form-group">
                <input type="hidden" name="id" value={{$data['id']}}>
                <label for="name" class="col-xs-2 control-label">Name:</label>
                <div class="col-xs-8">
                    <input type="text" name="name" value="{{$data['name']}}" class="form-control" placeholder="Enter service's name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="icon" class="col-xs-2 control-label">Service's Icon:</label>
                <div class="col-xs-8">
                    <input type="text" name="icon" value="{{$data['icon']}}" class="form-control" placeholder="Enter service's Icon" required>
                </div>
            </div>
            <div class="form-group">
                <label for="text" class="col-xs-2 control-label">Description:</label>
                <div class="col-xs-8">
                    <textarea name="text"  id="editor" class="form-control" placeholder="Enter service's description" required>{{$data['text']}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button class="btn btn-primary" type="submit">UPDATE THIS SERVICE</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
@endsection
