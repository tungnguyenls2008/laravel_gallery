
    <head>
        <link href="/css/gallery.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <br>
    <h2>Our Gallery</h2>
    <div class="wrapper">
        @foreach($galleries as $gallery)
            <input type="checkbox" id="img{{$gallery->id}}">
            <label for="img{{$gallery->id}}" class="lightbox"><img src="/img/gallery/{{$gallery->image}}" alt="{{$gallery->name}}"></label>
        @endforeach
        <div class="frame">
            @foreach($galleries as $gallery)
                <label for="img{{$gallery->id}}" class="item"><img src="/img/gallery/{{$gallery->image}}" alt="{{$gallery->name}}"></label>
            @endforeach

        </div>
    </div>
    </body>


