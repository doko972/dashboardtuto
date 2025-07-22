@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Video</h3>

        <a href="{{ route('admin.video.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Title</th> 
        <td>{{ $video->title }}</td>
</tr>
    <tr>
        <th>Url</th> 
        <td>{{ $video->url }}</td>
</tr>
    <tr>
        <th>Duration</th> 
        <td>{{ $video->duration }}</td>
</tr>
    <tr>
        <th>Description</th> 
        <td>{{ $video->description }}</td>
</tr>
    <tr>
        <th>Role</th> 
        <td>{{ $video->role }}</td>
</tr>
    <tr>
        <th>Created_by</th> 
        <td>{{ $video->created_by }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.video.edit', ['id' => $video->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection