<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\servicesimage;
use App\services;
use Carbon\Carbon;
class AdminUploadController extends Controller
{
    //
    function postImages(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $imageFiles = $request->file('file');
                var_dump($imageFiles);
                // set destination path
                $folderDir = 'public/uploads/services';
                $destinationPath = base_path() . '/' . $folderDir;
               //  // this form uploads multiple files
                foreach ($request->file('file') as $fileKey => $fileObject ) {
                    // make sure each file is valid
                    if ($fileObject->isValid()) {
                        // make destination file name
                        $destinationFileName = $fileObject->getClientOriginalName();
                        // move the file from tmp to the destination path
                        $fileObject->move($destinationPath, $destinationFileName);
                        // save the the destination filename
                        $servicesImage = new servicesimage;
			            $servicesImage->image_path = $folderDir . '/' . $destinationFileName;
			            $servicesImage->title = $destinationFileName;
			            $servicesImage->save();
                    }
                }
            }
        }
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('id');
        servicesimage::where('title',$filename)->delete();
        // $path=public_path().'/images/'.$filename;
        $path='public/uploads/services/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }
}
