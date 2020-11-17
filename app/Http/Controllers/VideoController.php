<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Google_Client;
use Google_Service_YouTube;

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
        /**
         * Sample PHP code for youtube.liveBroadcasts.list
         * See instructions for running these code samples locally:
         * https://developers.google.com/explorer-help/guides/code_samples#php
         */

        // if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
        //     throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
        // }
        // require_once __DIR__ . '/vendor/autoload.php';
        
        $client = new Google_Client();
        $client->setApplicationName('test');
        $client->setDeveloperKey('AIzaSyCeRyYeYdU8Y4AkwCO-qka9dLeVBPwJo-Q');
        
        // Define service object for making API requests.
        $service = new Google_Service_YouTube($client);

        $videoIds = [$id];

        $queryParams = [
            //'id' => implode(",",$videoIds)
            'id' => $id
        ];

        //dd($queryParams);
        
        //$response = $service->videos->listVideos('contentDetails,fileDetails,id,liveStreamingDetails,localizations,player,processingDetails,recordingDetails,snippet,statistics,status,suggestions,topicDetails', $queryParams);
        $response = $service->videos->listVideos('contentDetails,id,liveStreamingDetails,localizations,player,recordingDetails,snippet,statistics,status,topicDetails', $queryParams);


        return view('videodata',['response' => $response]);
    }
}
