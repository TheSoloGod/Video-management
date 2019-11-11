<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    function index()
    {
        return view('file_upload');
    }

    function upload(Request $request)
    {
        $rules = array(
            'video'  => 'required|mimes:mp4|max:2048000'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('video');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $output = array(
            'success' => 'Video uploaded successfully',
            'image'  => '<video width="100%" height="auto" controls src="/images/'.$new_name.'" ></video>'
        );

        sleep(5);
        return response()->json($output);
    }
}
