<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pictures = Picture::orderBy('created_at', 'DESC')->paginate(10);
        return view('picture',compact('pictures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:80',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');  
            $filenameWithoutEx = Str::slug($request->name) . '-' . time(); 
            $filename = $filenameWithoutEx . '.' . $file->getClientOriginalExtension(); 
            $file->storeAs('public/pictures', $filename); 
            $size = $request->size;
            $color = $request->color;
            $horizontal = $request->align;
            $vertical = $request->valign;
            $img = Image::make(storage_path('app/public/pictures/' . $filename));
            $img->text($request->name, 120, 100, function($font) use($size,$color,$horizontal,$vertical) {  
                $font->file(public_path('Cambridge.ttf'));   
                $font->size($size);
                $font->color($color);
                $font->align($horizontal);
                $font->valign($vertical);  
                $font->angle(0);  
            });
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $filenameWatermark = $filenameWithoutEx . '_watermark.' . $file->getClientOriginalExtension(); 
            $img->save(storage_path('app/public/pictures/' . $filenameWatermark));

            Picture::create([
                'name' => $request->name,
                'original_image' => $filename,
                'image' => $filenameWatermark
            ]);
            return redirect()->back()->with('result',$filenameWatermark)->with('request',$request->name)->with(['success' => 'Watermark Successfully']);
        }
        return redirect()->back()->with(['error' => 'File not found']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Picture $picture)
    {
        //
    }
}
