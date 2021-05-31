<?php

namespace App;

use App\Models\Video;
use Illuminate\Support\Facades\Cache;
use App\Service\YoutubeApi;

class Refresh
{
    public static function all(YoutubeApi $youtubeApi)
    {
        $videos = Video::All();
        foreach ($videos as $video) {
            $videoMetaData = $youtubeApi->getVideoMetaData($video->id);
            if (!$videoMetaData){
                continue;
            }
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
                ->push();
        }

        Cache::flush();

        return true;
    }
}
