<div class="wrapper container-fluid">
    <form action="{{ route('pagesAdd') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf
    <div class="form-group">
        <label for="name" class="col-xs-2 control-label">Tittle:</label>
        <div class="col-xs-8">
            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Artwork Tittle" required>
        </div>
    </div>
    <div class="form-group">
        <label for="alias" class="col-xs-2 control-label">Tags:</label>
        <div class="col-xs-8">
            <input type="text" name="alias" value="{{old('alias')}}" class="form-control" placeholder="Enter Artwork tags" required>
        </div>
    </div>

    <div class="form-group">
        <label for="text" class="col-xs-2 control-label">Description:</label>
        <div class="col-xs-8">
            <textarea name="text"  id="editor" class="form-control" placeholder="Enter Artwork Description" required>{{old('text')}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="images" class="col-xs-2 control-label">The Art It Self:</label>
        <div class="col-xs-8">
            <input type="file" class="filestyle" name="images" value="{{old('text')}}" data-placeholder="Upload a visual image of the Artwork here">
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <button class="btn btn-primary" type="submit">Submit!</button>
        </div>
    </div>
    </form>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
</div>
