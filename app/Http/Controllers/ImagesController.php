<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use victorycto\imageservice\imageservice;
use victorycto\imageservice\Models\Image;

class ImagesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:500000'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $title = $request->input('title');
            $imageService = new imageservice();
            $imageModel = $imageService->saveImage($file, $title);
        }
        return back()->withSuccess('Image uploaded successfully');
    }
}
