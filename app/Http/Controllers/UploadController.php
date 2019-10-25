<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
//        dd($request->file());
        $name = $request->file->getClientOriginalName();
        $request->file->storeAs('/', $name, 'google');

        return 'File was saved to Google Drive';
    }
}
