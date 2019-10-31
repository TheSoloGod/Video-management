<?php


namespace App\Services;


class StoreImageService
{
    public $inputName = 'image';

    public function buildData($request, $folder, $imageDefault)
    {
        $data = $request->all();
        if ($request->hasFile($this->inputName)){
            $image = $request->file($this->inputName);
            $imageName = $image->getClientOriginalName();
            $imageExtension = $image->getClientOriginalExtension();
            $image->move('storage/' . $folder, $imageName);
            $data[$this->inputName] = $imageName;
        } else {
            $data[$this->inputName] = $imageDefault;
        }
        return $data;
    }
}
