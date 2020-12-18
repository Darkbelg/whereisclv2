<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Video;
use App\Service\YoutubeApi;
use Illuminate\Http\Request;

class RefreshController extends Controller
{
    private $youtubeApi;

    public function __construct(YoutubeApi $youtubeApi)
    {
        $this->youtubeApi = $youtubeApi;
    }

    public function refreshAll()
    {
        $videos = Video::All();
        foreach ($videos as $video) {
            $videoMetaData = $this->youtubeApi->getVideoMetaData("JeGhUESd_1o");
            $videoMetaDataSnippet = $videoMetaData["snippet"];
            $videoMetaDataStatistics = $videoMetaData["statistics"];

            $video->title = $videoMetaDataSnippet["title"] ?: $video->title;
            $video->description = $videoMetaDataSnippet["description"] ?: $video->description;
            $video->comments = $videoMetaDataStatistics["commentCount"] ?: $video->comments;
            $video->dislikes = $videoMetaDataStatistics["dislikeCount"] ?: $video->dislikes;
            $video->likes = $videoMetaDataStatistics["likeCount"] ?: $video->likes;
            $video->views = $videoMetaDataStatistics["viewCount"] ?: $video->views;

            $video->updateTags($videoMetaDataSnippet["tags"])
                ->updateThumbnails($videoMetaDataSnippet["thumbnails"])
                ->save();
        }

        return redirect('/');
    }
}
