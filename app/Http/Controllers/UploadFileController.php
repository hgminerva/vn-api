<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        //added this to test the upload in api
        return view('/uploadFiles/fileUpload');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadFileRequest $request)
    {
        
        $directory = 'uploads';//$directory = 'files'; // S3 bucket directory
        // This will automatically create a hash version of the file upload
        // Example: ahPODlvWr2JMHmL5xBmsnhewDLsQss9jqpHTFTOM.jpg
       // $request->file('file')->store($directory, [
       //     'disk' => 'local', // Let's specify that we want to store it in S3
       // ]);
        // If you want to have a control on generating the filename to S3
        // then you should use this instead
        $fileName = time().'.'.$request->file->extension();  
        $request->file('file')->storeAs($directory, $fileName, [
            'disk' => 'public',
        ]);

        return response()->json(['message' => 'Successfully uploaded']);
    }
}
