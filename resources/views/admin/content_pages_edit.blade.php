<div class="wrapper container-fluid">
    <form action="{{ route('pagesEdit', array('page'=>$data['id'])) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf
    <div class="form-group">
        <input type="hidden" name="id" value={{$data['id']}}>
        <label for="name" class="col-xs-2 control-label">Name:</label>
        <div class="col-xs-8">
            <input type="text" name="name" value="{{$data['name']}}" class="form-control" placeholder="Enter page's name" required>
        </div>
    </div>

    <div class="form-group">
        <label for="alias" class="col-xs-2 control-label">Tags:</label>
        <div class="col-xs-8">
            <input type="text" name="alias" value="{{$data['alias']}}" class="form-control" placeholder="Enter page's tags" required>
        </div>
    </div>

    <div class="form-group">
        <label for="text" class="col-xs-2 control-label">Description:</label>
        <div class="col-xs-8">
            <textarea name="text"  id="editor" class="form-control" placeholder="Enter page's description" required>{{$data['text']}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="old_images" class="col-xs-2 control-label">Artwork:</label>
        <div class="col-xs-offset-2 col-xs-10">
            <img src="/img/{{ $data['images'] }}" class="img-thumbnail img-responsive" width="150px" >
            <input type="hidden" name="old_images" value={{$data['images']}}>
        </div>
    </div>

    <div class="form-group">
        <label for="images" class="col-xs-2 control-label">Artwork:</label>
        <div class="col-xs-8">
            <input type="file" class="filestyle" name="images" value="{{old('text')}}" data-placeholder="No file chosen yet">
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <button class="btn btn-primary" type="submit">UPDATE THIS PAGE</button>
        </div>
    </div>

    </form>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
</div>
