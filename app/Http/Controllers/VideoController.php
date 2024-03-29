<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoPostRequest;
use App\Models\Channel;
use App\Models\Event;
use App\Models\Video;
use App\Rules\EmptyArray;
use App\Service\YoutubeApi;
use Exception;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    private $youtubeApi;

    public function __construct(YoutubeApi $youtubeApi)
    {
        $this->youtubeApi = $youtubeApi;
    }

    /*
    * Get's the meta data of a video by the parameter id
    * @param $id String Youtube video ID
    */
    public function getVideoMetaDataById($id)
    {
        $videoMetaData = $this->youtubeApi->getVideoMetaData($id);
        if (!$videoMetaData){
            return redirect('/dashboard')->with('status', 'Getting video meta data failed.');
        }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoPostRequest $request)
    {
        try {
            $event = Event::find($request->event);

            foreach (array_filter($request->youtube) as $youtubeId) {
                $this->storeOneVideo($youtubeId, $event);
            }

            return redirect('/videos/');
        } catch (\Exception $e) {
            Log::error($e);

            return redirect('/videos/')->with('status', 'Something went wrong saving all videos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('videos.show', ["video" => $video]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->detach();
        $video->delete();

        return redirect('/videos');
    }

    public function storeOneVideo($youtubeId, $event)
    {
        $videoMetaData = $this->youtubeApi->getVideoMetaData($youtubeId);
        if (!$videoMetaData) {
            return;
        }
        $videoMetaDataSnippet = $videoMetaData["snippet"];
        $videoMetaDataStatistics = $videoMetaData["statistics"];

        $channel = Channel::find($videoMetaDataSnippet['channelId']);

        if ($channel === null) {
            $channel = Channel::create([
                'id' => $videoMetaDataSnippet['channelId'],
                'title' => $videoMetaDataSnippet['channelTitle']
            ]);
        }

        $video = $channel->videos()->create([
            "id" => $youtubeId,
            "title" => $videoMetaDataSnippet["title"],
            "description" => $videoMetaDataSnippet["description"],
            "published_at" => date('Y-m-d h:i:s', strtotime($videoMetaDataSnippet["publishedAt"])),
            "comments" => $videoMetaDataStatistics["commentCount"] ?: 0,
            "dislikes" => $videoMetaDataStatistics["dislikeCount"] ?: 0,
            "likes" => $videoMetaDataStatistics["likeCount"] ?: 0,
            "views" => $videoMetaDataStatistics["viewCount"] ?: 0
        ]);

        $event->videos()->attach($video->id);

        $video->updateTags($videoMetaDataSnippet["tags"])->updateThumbnails($videoMetaDataSnippet["thumbnails"]);

        return $video;
    }
}
