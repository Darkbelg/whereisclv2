<?php

namespace App\Service;

use App\Models\Video;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Log;

/**
 * Class YoutubeApi
 * @package App\Service
 */
class YoutubeApi
{

    private $service;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setApplicationName(config("youtube.api.name"));
        $client->setDeveloperKey(config("youtube.api.key"));

        // Define service object for making API requests.
        $this->service = new Google_Service_YouTube($client);
    }

    /**
     * @param $id
     * @return false
     * @throws \Exception
     */
    public function getVideoMetaData($id)
    {
        $queryParams = [
            'id' => $id
        ];

        try {
            $response = $this->service->videos->listVideos(
                'contentDetails,id,liveStreamingDetails,localizations,player,recordingDetails,snippet,statistics,status,topicDetails',
                $queryParams
            );
        } catch (\Exception $ex) {
            Log::error($ex);
            return false;
        }
        if (isset($response["items"][0])) {
            return $response["items"][0];
        }
        if (!isset($response["items"])) {
            $video = Video::findOrFail($id);
            $video->detach();
            $video->delete();
        }
        return false;
    }
}
