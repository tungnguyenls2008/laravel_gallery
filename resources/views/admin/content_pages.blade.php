<div style="margin:0px 50px 0px 50px;">

    @if($pages)

        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Tags</th>
                <th>Description</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $k => $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td><a href="{{route('pagesEdit',['page'=>$page->id])}}" alt="{{$page->name}}">{{$page->name}}</a></td>
                    <td>{{ $page->alias }}</td>
                    <td>{{ $page->text }}</td>
                    <td>{{ $page->created_at }}</td>
                    <td>
                        <form action="{{route('pagesEdit',['page'=>$page->id])}}" class="form-horizontal" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('pagesAdd') }}">Add new Artwork</a>
</div>
