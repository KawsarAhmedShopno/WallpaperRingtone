<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;


class PhotoController extends Controller
{
    public function wall()
    {
        $photos = Photo::latest()->get();
        return view('photoDisplay', compact('photos'));
    }
    public function download1($id)
    {
        $image = Photo::find($id);
        $imageName = $image->file;
        $filepath = public_path('upload/') . $imageName;
        return \Response::download($filepath);
    }
    public function download2($id)
    {
        $image = Photo::find($id);
        $imageName = $image->file;
        $filepath = public_path('upload/') . $imageName;
        return \Response::download($filepath);
    }
    public function download3($id)
    {
        $image = Photo::find($id);
        $imageName = $image->file;
        $filepath = public_path('upload/') . $imageName;
        return \Response::download($filepath);
    }
    public function download4($id)
    {
        $image = Photo::find($id);
        $imageName = $image->file;
        $filepath = public_path('upload/') . $imageName;
        return \Response::download($filepath);
    }
}
