<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\conceptimage;
use App\concept;
use Carbon\Carbon;
class AdminUploadConceptController extends Controller
{
    //
    function postImages(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $imageFiles = $request->file('file');
                var_dump($imageFiles);
                // set destination path
                $folderDir = 'public/uploads/concept';

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
                        $conceptImage = new conceptimage;
			            $conceptImage->image_path = $folderDir . '/' . $destinationFileName;
			            $conceptImage->title = $destinationFileName;
			            $conceptImage->save();
                    }
                }
            }
        }
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('id');
        conceptimage::where('title',$filename)->delete();
        // $path=public_path().'/images/'.$filename;
        $path='public/uploads/concept/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }
}
