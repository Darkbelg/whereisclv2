<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Service\YoutubeApi;
use Exception;

class VideoController extends Controller
{
    private $youtubeApi;

    public function __construct(YoutubeApi $youtubeApi)
    {
        $this->youtubeApi = $youtubeApi;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /*
    * Get's the meta data of a video by the parameter id
    * @param $id String Youtube video ID
    */
    public function getVideoMetaDataById($id)
    {
        $videoMetaData = $this->youtubeApi->getVideoMetaData($id);
        
        return view('videodata', ['response' => $videoMetaData]);
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
    public function store()
    {
        request()->validate([
            'youtube_id' => 'required',
            'event' => 'required'
        ]);

        $event = Event::find(request('event'));

        $videoMetaData = $this->youtubeApi->getVideoMetaData(request('youtube_id'));
        $videoMetaDataSnippet = $videoMetaData["snippet"];
        $videoMetaDataStatistics = $videoMetaData["statistics"];

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
            "comments" => $videoMetaDataStatistics["commentCount"] ?: 0,
            "dislikes" => $videoMetaDataStatistics["dislikeCount"] ?: 0,
            "likes" => $videoMetaDataStatistics["likeCount"] ?: 0,
            "views" => $videoMetaDataStatistics["viewCount"] ?: 0
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
