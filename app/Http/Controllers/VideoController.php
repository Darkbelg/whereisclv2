<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Video;
use Exception;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\App;

class VideoController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
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

        if (request()->method() === "POST") {
            return $response["items"][0];
        } else {
            return view('videodata', ['response' => $response]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::All();
        return view("videos.index", ["videos" => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create', ['events' => Event::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'youtube_id' => 'required',
            'event' => 'required'
        ]);

        $event = Event::find(request('event'));

        $videoMetaData = $this->getVideoMetaDataById(request('youtube_id'));
        $videoMetaDataSnippet = $videoMetaData["snippet"];
        $tags = $videoMetaDataSnippet["tags"];
        $thumbnails = $videoMetaDataSnippet["thumbnails"];

        $channel = Channel::firstOrCreate([
            'id' => $videoMetaDataSnippet['channelId'],
            'title' => $videoMetaDataSnippet['channelTitle']
        ]);

        $video = $channel->videos()->create([
            "id" => request('youtube_id'),
            "title" => $videoMetaDataSnippet["title"],
            "description" => $videoMetaDataSnippet["description"],
            "published_at" => date('Y-m-d h:i:s', strtotime($videoMetaDataSnippet["publishedAt"])),
            "comments" => $videoMetaData["statistics"]["commentCount"] ?: 0,
            "dislikes" => $videoMetaData["statistics"]["dislikeCount"] ?: 0,
            "likes" => $videoMetaData["statistics"]["likeCount"] ?: 0,
            "views" => $videoMetaData["statistics"]["viewCount"] ?: 0
        ]);

        $event->videos()->attach($video->id);

        foreach ((array)$tags as $tag) {
            $video->tags()->create([
                "tag" => $tag
            ]);
        }

        foreach ($thumbnails as $size => $thumbnail) {
            $video->thumbnails()->create([
                'size' => $size,
                'url' => $thumbnail["url"],
                'height' => $thumbnail["height"],
                'width' => $thumbnail["width"]
            ]);
        }

        return redirect('/videos/' . $video->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('videos.show', ["video" => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        throw new Exception("Video info can not be updated");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        throw new Exception("Video info can not be updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->tags()->detach();
        $video->events()->detach();
        $video->thumbnails()->delete();
        $video->delete();

        return redirect('/videos');
    }
}
