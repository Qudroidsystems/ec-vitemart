<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request) {
        $extension = $request->file('file')->getClientOriginalExtension();
        while (true) {
            $slug = uniqid();

            if (!Upload::where('name', $slug)->first()) {
                $path = $slug . '.' . $extension;
                move_uploaded_file($request->file('file'), '../public/uploads/' . $path);
                
                Upload::create([
                    'name' => $slug,
                    'ext' => $extension
                ]);
                
                return $slug;
            }
        }

    }
}
