<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ringtone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RingtoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ringtones = Ringtone::latest()->get();
        return view('backend.ringtone.index', compact('ringtones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ringtone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:mp3,wav|max:2000',
            'category' => 'required'

        ]);
        $fileName = $request->file->HashName();
        $format = $request->file->getClientoriginalExtension();
        $size = $request->file->getSize();
        $request->file->move(public_path('audio'), $fileName);

        Ringtone::create([

            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'slug' => $request->get(Str::slug('title', '-')), //notworking properly
            'category_id' => $request->get('category'),
            'format' => $format,
            'size' => $size,
            'file' => $fileName

        ]);
        return redirect()->back()->with('message', 'Ringtone  Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rings = Ringtone::find($id);
        return view('backend.ringtone.edit', compact('rings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',

            'category' => 'required'

        ]);
        $rings = Ringtone::find($id);
        $fileName = $rings->file;
        $format = $rings->format;
        $size = $rings->size;
        $download = $rings->download;

        if ($request->hasFile('file')) {
            $fileName = $request->file->HashName();
            $format = $request->file->getClientoriginalExtension();
            $size = $request->file->getSize();
            $request->file->move(public_path('audio'), $fileName);
            unlink(public_path('/audio/' . $rings->file));
            $download = 0;
        }
        $rings->title = $request->get('title');
        $rings->description = $request->get('description');
        $rings->slug = $request->get(Str::slug('title', '-'));
        $rings->category_id = $request->get('category');
        $rings->format = $format;
        $rings->size = $size;
        $rings->file = $fileName;
        $rings->download = $download;

        $rings->save();
        return redirect()->back()->with('message', 'Ringtone  updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rings = Ringtone::find($id);

        $rings->delete();
        unlink(public_path('/audio/' . $rings->file));
        return redirect()->back()->with('message', 'Ringtone  deleted');
    }
}
