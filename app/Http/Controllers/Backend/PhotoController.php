<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use  Image;



class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('backend.photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.photo.create');
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
            'file' => 'required'


        ]);
        $image = $request->file('file');
        $fileName = $image->HashName();
        $format = $request->file->getClientoriginalExtension();
        $size = $request->file->getSize();

        $path = 'upload/' . $fileName;
        $path1 = 'upload/118x95' . $fileName;
        $path2 = 'upload/316x255' . $fileName;
        $path3 = 'upload/1280x1024' . $fileName;

        Image::make($image->getRealPath())->resize(800, 600)->save($path);
        Image::make($image->getRealPath())->resize(118, 95)->save($path);
        Image::make($image->getRealPath())->resize(316, 255)->save($path);
        Image::make($image->getRealPath())->resize(1280, 1024)->save($path);

        $photos = new Photo;
        $photos->title = $request->get('title');
        $photos->description = $request->get('description');
        $photos->format = $format;
        $photos->size = $size;
        $photos->file = $fileName;
        $photos->save();

        return redirect()->back()->with('message', 'Photo  Created');
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
        $photos = Photo::find($id);
        return view('backend.photo.edit', compact('photos'));
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
        //validation
        $this->validate($request, [
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:500',

        ]);
        //details of the photo from db
        $photo = Photo::find($id);
        $fileName = $photo->file;
        // dd($fileName);
        $format = $photo->format;
        $size = $photo->size;

        //if user is uploaded new photo
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newfilename = $image->hashName();
            $size = $request->image->getSize();

            $format = $request->image->getClientOriginalExtension();


            $path = 'upload/' . $newfilename;
            $path1 = 'upload/1280x1024/' . $newfilename;
            $path2 = 'upload/316x255/' . $newfilename;
            $path3 = 'upload/118x95/' . $newfilename;
            //upload and resize new updated image
            Image::make($image->getRealPath())->resize(800, 600)->save($path);
            Image::make($image->getRealPath())->resize(1280, 1024)->save($path1);
            Image::make($image->getRealPath())->resize(316, 255)->save($path2);
            Image::make($image->getRealPath())->resize(118, 95)->save($path3);
            //delete the previous image 
            unlink(public_path('upload/' . $photo->file));
            unlink(public_path('upload/1280x1024/' . $photo->file));
            unlink(public_path('upload/316x255/' . $photo->file));
            unlink(public_path('upload/118x95/' . $photo->file));
            $photo->title = $request->get('title');
            $photo->description = $request->get('description');

            $photo->format = $format;
            $photo->size = $size;
            //save new file name in db
            $photo->file = $newfilename;

            $photo->save();
            return redirect()->back()->with('message', "Photo Updated successfully!");
        } else {
            //if user has not uploaded new photo just want to change title and description
            $photo->title = $request->get('title');
            $photo->description = $request->get('description');

            $photo->format = $format;
            $photo->size = $size;
            $photo->file = $fileName;

            $photo->save();
            return redirect()->back()->with('message', "Photo Updated successfully!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Photos = Photo::find($id);

        $Photos->delete();
        unlink(public_path('upload/' . $Photos->file));
        return redirect()->back()->with('message', 'Photo  deleted');
    }
}
