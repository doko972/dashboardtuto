@extends('admin')

@section('content')
<div >
    <h3>Create Video</h3>
    <a href="{{ route('admin.video.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('videos/videoForm')
        </div>
@endsection
