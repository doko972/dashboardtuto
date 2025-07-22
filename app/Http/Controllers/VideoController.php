<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VideoFormRequest;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::orderBy('created_at', 'desc')->paginate(5);
        return view('videos/index', ['videos' => $videos]);
    }

    public function show($id): View
    {
        $video = Video::findOrFail($id);

        return view('videos/show',['video' => $video]);
    }
    public function create(): View
    {
        return view('videos/create');
    }

    public function edit($id): View
    {
        $video = Video::findOrFail($id);
        return view('videos/edit', ['video' => $video]);
    }

    public function store(VideoFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        

        $video = Video::create($data);
        return redirect()->route('admin.video.show', ['id' => $video->id]);
    }

    public function update(Video $video, VideoFormRequest $req)
    {
        $data = $req->validated();

        

        $video->update($data);

        return redirect()->route('admin.video.show', ['id' => $video->id]);
    }

    public function updateSpeed(Video $video, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $video->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Video $video)
    {
        
        $video->delete();

        return [
            'isSuccess' => true
        ];
    }

    
}