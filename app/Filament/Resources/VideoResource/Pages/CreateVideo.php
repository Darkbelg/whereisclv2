<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use App\Models\Channel;
use App\Service\YoutubeApi;
use Filament\Resources\Pages\CreateRecord;
use Google\Service\YouTube\Resource\Youtube;
use Illuminate\Database\Eloquent\Model;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;


    protected function handleRecordCreation(array $data): Model
    {

        return $this->storeOneVideo($data["id"]);

    }


    public function storeOneVideo($youtubeId)
    {
        $videoMetaData = (new YoutubeApi())->getVideoMetaData($youtubeId);
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

        $video->updateTags($videoMetaDataSnippet["tags"])->updateThumbnails($videoMetaDataSnippet["thumbnails"]);

        return $video;
    }
}
