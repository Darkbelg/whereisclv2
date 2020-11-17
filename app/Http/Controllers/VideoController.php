<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        return view('create');
    }

    public function store()
    {
        $data = json_encode(request());
        Video::create($data);
  
        return back()->withSuccess('Data successfully store in json format');  
    }

    /*
    * Get's the meta data of a video by the parameter id
    * @param $id String Youtube video ID
    */
    public function getVideoMetaDataById($id)
    {
        return $id;
    }
}
