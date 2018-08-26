<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    public function index() {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create() {
        return view('admin.media.create');
    }

    public function store(Request $request) {
        // Get each file from dropzone
        $file = $request->file('file');
        // Create filename
        $name = time() . $file->getClientOriginalName();
        // Save file in public/images with name $name
        $file->move('images', $name);
        // Save in db
        Photo::create(['file'=>$name]);
    }

    public function destroy($id) {
        $photo = Photo::findOrFail($id);
        unlink(public_path() . '/images/' . $photo->file);
        $photo->delete();
        
        Session::flash('notification', 'Image was successfuly deleted.');
        return redirect('/admin/media');
    }
}
