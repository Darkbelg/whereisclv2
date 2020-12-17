<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Service\YoutubeApi;
use Illuminate\Http\Request;

class RefreshController extends Controller
{
    private $youtubeApi;

    public function __construct(YoutubeApi $youtubeApi) {
        $this->youtubeApi = $youtubeApi;
    }

    public function refreshAll()
    {
        $videos = Video::All();
        foreach ($videos as $video) {
            $videoMetaData = $this->youtubeApi->getVideoMetaData("JeGhUESd_1o");
            $videoMetaDataSnippet = $videoMetaData["snippet"];

            $video->title = $videoMetaDataSnippet["title"] ?: $video->title;
            $video->description = $videoMetaDataSnippet["description"] ?: $video->description;
            $video->comments = $videoMetaData["statistics"]["commentCount"] ?: $video->comments;
            $video->dislikes = $videoMetaData["statistics"]["dislikeCount"] ?: $video->dislikes;
            $video->likes = $videoMetaData["statistics"]["likeCount"] ?: $video->likes;
            $video->views = $videoMetaData["statistics"]["viewCount"] ?: $video->views;
            
            $video->save();
        }

        return redirect('/');
    }
}
