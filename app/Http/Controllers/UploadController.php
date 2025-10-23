<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120',
        ]);

        $file = $request->file('file');
        $path = $file->storeAs(
            'uploads',
            Str::uuid() . '.' . $file->getClientOriginalExtension(),
            'public'
        );

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }
}
