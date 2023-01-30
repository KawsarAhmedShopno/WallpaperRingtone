<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ringtone;
use App\Models\Category;
use Facade\FlareClient\Http\Response;


class RingtoneController extends Controller
{

    public function index()
    {
        $rings = Ringtone::latest()->paginate(20);
        $categories = Category::latest()->get();
        return view('index', compact('rings', 'categories'));
    }
    public function show($id, $slug)
    {
        $ring = Ringtone::where('id', $id)->where('slug', $slug)->first();
        $categories = Category::latest()->get();

        return view('show', compact('ring', 'categories'));
    }
    public function download($id)
    {
        $ring = Ringtone::find($id);
        $ringpath = $ring->file;
        $filePath = public_path('audio/') . $ringpath;
        $ring->increment('download');
        $ring->save();
        return \Response::download($filePath);
    }
    public function category($id)
    {
        $ringtones  = Ringtone::where('category_id', $id)->paginate(20);
        return view('ringtone-category', compact('ringtones'));
    }
}
