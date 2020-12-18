<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\Video;
use App\Service\YoutubeApi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RefreshTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_refresh_all_video_data()
    {
        $this->signIn();

        $videos = Video::factory(5)->create(['id' => "JeGhUESd_1o","views" => "100"]);

        $mock = $this->partialMock(YoutubeApi::class, function ($mock) {
            $mock->shouldReceive('getVideoMetaData')->andReturn($this->getVideoMetaDataById());
        });
        
        $response = $this->withoutExceptionHandling()->get("/refresh")->assertRedirect('/');

        $videoDatabaseFirst = Video::all()->first();
        $videoDatabaseLast = Video::all()->last();

        $this->assertEquals('45',count($videoDatabaseFirst->tags));
        $this->assertEquals('45',count($videoDatabaseLast->tags));
        $this->assertNotEquals('100',$videoDatabaseFirst->views);
        $this->assertNotEquals('100',$videoDatabaseLast->views);
    }

    public function getVideoMetaDataById()
    {
        $youtubeVideoJsonApiData = <<<'JSONDATA'
        {
        "etag": "N_UqmX2GO8Z74w8JBDS27hwe-a4",
        "eventId": null,
        "kind": "youtube#videoListResponse",
        "nextPageToken": null,
        "prevPageToken": null,
        "visitorId": null,
        "items": [
            {
            "etag": "v5tHQiOZt3YG3Dfi20DFxGHmuyA",
            "id": "JeGhUESd_1o",
            "kind": "youtube#video",
            "snippet": {
                "categoryId": "10",
                "channelId": "UCuX8lXIexG8dRXFx54CVm2Q",
                "channelTitle": "Mock CL Official Channel",
                "defaultAudioLanguage": "en",
                "defaultLanguage": null,
                "description": "+5 STAR+ OUT NOW\nhttp://chaelincl.lnk.to/hwafivestar\n\nMore about CL @\nInstagram: https://www.instagram.com/chaelinCL\nTwitter: https://www.twitter.com/chaelinCL\nFacebook: https://www.facebook.com/chaelinCL\nYouTube: https://www.youtube.com/chaelinCL\nApple Music: https://music.apple.com/us/artist/cl/655853528 \nSpotify: https://open.spotify.com/artist/0tzSBCPJZmHTdOA3ZV2mN3?si=Az7wY0moQra1KoxDIoz9Ow\nWeibo: https://weibo.com/CLGZB?is_all=1\nLittle Red Book: http://suo.im/5F1kkQ\nTikTok: https://www.tiktok.com/@chaelincl\nDouyin: https://v.douyin.com/JP5oTLw/\n\nLyrics: \n\n무슨 말이 더 필요해?\nBoy I got you in my arms\n너만 있으면 돼\n별 하나 없던 이 밤이\n빛나네\n머리위에 저 천장이\n돌고 도네\n\nDon’t let me go tonight\n오늘 집에 가지마\n둘만의 섬 위에 \nI’m your ocean you ma star\nyeah til six in the morning\nBaby don’t stop keep it coming \nMake me feel so good\n내일 기억할 수 있게\n\nI can’t stop thinkin’ about you\n5 stars everytime that you come thru\noh my god\n미쳤나봐\noh my god\nCan’t get enough\nBaby\nI can’t stop thinkin’ about you\n5 stars every little thing you do\noh my god\n미쳤나봐\noh my god\nCan’t get enough\n\n전화해 오는 길에 목소리 듣게\n기대해 if you’re hungry\n너를 위해\nGo crazy baby\n너의 파도를 오늘 밤 타\n\nDon’t let me go tonight\n오늘 집에 가지마\n둘만의 섬 위에 \nYou ma ocean I'm your star\nYeah til six in the morning\nBaby don’t stop keep it coming \nMake me feel so good\n내일 기억할수있게\n\nI can’t stop thinkin’ about you\n5 stars everytime that you come thru\noh my god\n미쳤나봐\noh my god\nCan’t get enough\nI can’t stop thinkin’ about you\n5 stars every little thing you do\noh my god\n미쳤나봐\noh my god\nCan’t get enough\n\n무슨 말이 더 필요해?\nWith you I feel perfect\ngimme everythin’ I wanted\nyou know I’m worth it\n제발 날 깨우지마\n이꿈에서 날 깨우지마\n\nI can’t stop thinkin’ about you\n5 stars everytime that you come thru\noh my god\n미쳤나봐\noh my god\nCan’t get enough\nBaby\n\n\n#CL  #씨엘 #5STAROfficialVideo #5STAR #5스타\n#CHAELINLEE #CHAELIN #이채린 #채린",
                "liveBroadcastContent": "none",
                "publishedAt": "2020-11-06T04:00:09Z",
                "tags": [
                "CL",
                "chanel",
                "cl official",
                "kpop",
                "inthenameoflove",
                "k-pop",
                "cherry",
                "씨엘",
                "이채린",
                "채린",
                "CHAELINLEE",
                "hello bitches",
                "cl hello b",
                "cl lifted",
                "cl hello bitches",
                "2ne1",
                "cl hello b lyric",
                "lifted cl",
                "cl the baddest female",
                "ddu du ddu du remix",
                "cl baddest female",
                "hello bitches cl",
                "the baddest female",
                "lifted",
                "cl 2ne1",
                "cl hello",
                "g dragon",
                "cl hello b reaction",
                "hello biches",
                "hello bitch",
                "cl done",
                "bitches",
                "baddest female cl",
                "cl gd",
                "gd cl",
                "5star",
                "5 star",
                "5STAR",
                "5 STAR",
                "HWA",
                "AWH",
                "hwa",
                "i'm back",
                "+5 STAR+",
                "+5star+"
                ],
                "title": "Mock CL +5 STAR+ Official Video",
                "thumbnails": {
                "default": {
                    "height": 90,
                    "url": "https://i.ytimg.com/vi/JeGhUESd_1o/default.jpg",
                    "width": 120
                },
                "medium": {
                    "height": 180,
                    "url": "https://i.ytimg.com/vi/JeGhUESd_1o/mqdefault.jpg",
                    "width": 320
                },
                "high": {
                    "height": 360,
                    "url": "https://i.ytimg.com/vi/JeGhUESd_1o/hqdefault.jpg",
                    "width": 480
                },
                "standard": {
                    "height": 480,
                    "url": "https://i.ytimg.com/vi/JeGhUESd_1o/sddefault.jpg",
                    "width": 640
                },
                "maxres": {
                    "height": 720,
                    "url": "https://i.ytimg.com/vi/JeGhUESd_1o/maxresdefault.jpg",
                    "width": 1280
                }
                },
                "localized": {
                "description": "+5 STAR+ OUT NOW\nhttp://chaelincl.lnk.to/hwafivestar\n\nMore about CL @\nInstagram: https://www.instagram.com/chaelinCL\nTwitter: https://www.twitter.com/chaelinCL\nFacebook: https://www.facebook.com/chaelinCL\nYouTube: https://www.youtube.com/chaelinCL\nApple Music: https://music.apple.com/us/artist/cl/655853528 \nSpotify: https://open.spotify.com/artist/0tzSBCPJZmHTdOA3ZV2mN3?si=Az7wY0moQra1KoxDIoz9Ow\nWeibo: https://weibo.com/CLGZB?is_all=1\nLittle Red Book: http://suo.im/5F1kkQ\nTikTok: https://www.tiktok.com/@chaelincl\nDouyin: https://v.douyin.com/JP5oTLw/\n\nLyrics: \n\n무슨 말이 더 필요해?\nBoy I got you in my arms\n너만 있으면 돼\n별 하나 없던 이 밤이\n빛나네\n머리위에 저 천장이\n돌고 도네\n\nDon’t let me go tonight\n오늘 집에 가지마\n둘만의 섬 위에 \nI’m your ocean you ma star\nyeah til six in the morning\nBaby don’t stop keep it coming \nMake me feel so good\n내일 기억할 수 있게\n\nI can’t stop thinkin’ about you\n5 stars everytime that you come thru\noh my god\n미쳤나봐\noh my god\nCan’t get enough\nBaby\nI can’t stop thinkin’ about you\n5 stars every little thing you do\noh my god\n미쳤나봐\noh my god\nCan’t get enough\n\n전화해 오는 길에 목소리 듣게\n기대해 if you’re hungry\n너를 위해\nGo crazy baby\n너의 파도를 오늘 밤 타\n\nDon’t let me go tonight\n오늘 집에 가지마\n둘만의 섬 위에 \nYou ma ocean I'm your star\nYeah til six in the morning\nBaby don’t stop keep it coming \nMake me feel so good\n내일 기억할수있게\n\nI can’t stop thinkin’ about you\n5 stars everytime that you come thru\noh my god\n미쳤나봐\noh my god\nCan’t get enough\nI can’t stop thinkin’ about you\n5 stars every little thing you do\noh my god\n미쳤나봐\noh my god\nCan’t get enough\n\n무슨 말이 더 필요해?\nWith you I feel perfect\ngimme everythin’ I wanted\nyou know I’m worth it\n제발 날 깨우지마\n이꿈에서 날 깨우지마\n\nI can’t stop thinkin’ about you\n5 stars everytime that you come thru\noh my god\n미쳤나봐\noh my god\nCan’t get enough\nBaby\n\n\n#CL  #씨엘 #5STAROfficialVideo #5STAR #5스타\n#CHAELINLEE #CHAELIN #이채린 #채린",
                "title": "CL +5 STAR+ Official Video"
                }
            },
            "contentDetails": {
                "caption": "false",
                "definition": "sd",
                "dimension": "2d",
                "duration": "PT3M22S",
                "hasCustomThumbnail": null,
                "licensedContent": false,
                "projection": "rectangular",
                "contentRating": {
                "acbRating": null,
                "agcomRating": null,
                "anatelRating": null,
                "bbfcRating": null,
                "bfvcRating": null,
                "bmukkRating": null,
                "catvRating": null,
                "catvfrRating": null,
                "cbfcRating": null,
                "cccRating": null,
                "cceRating": null,
                "chfilmRating": null,
                "chvrsRating": null,
                "cicfRating": null,
                "cnaRating": null,
                "cncRating": null,
                "csaRating": null,
                "cscfRating": null,
                "czfilmRating": null,
                "djctqRating": null,
                "djctqRatingReasons": null,
                "ecbmctRating": null,
                "eefilmRating": null,
                "egfilmRating": null,
                "eirinRating": null,
                "fcbmRating": null,
                "fcoRating": null,
                "fmocRating": null,
                "fpbRating": null,
                "fpbRatingReasons": null,
                "fskRating": null,
                "grfilmRating": null,
                "icaaRating": null,
                "ifcoRating": null,
                "ilfilmRating": null,
                "incaaRating": null,
                "kfcbRating": null,
                "kijkwijzerRating": null,
                "kmrbRating": null,
                "lsfRating": null,
                "mccaaRating": null,
                "mccypRating": null,
                "mcstRating": null,
                "mdaRating": null,
                "medietilsynetRating": null,
                "mekuRating": null,
                "menaMpaaRating": null,
                "mibacRating": null,
                "mocRating": null,
                "moctwRating": null,
                "mpaaRating": null,
                "mpaatRating": null,
                "mtrcbRating": null,
                "nbcRating": null,
                "nbcplRating": null,
                "nfrcRating": null,
                "nfvcbRating": null,
                "nkclvRating": null,
                "nmcRating": null,
                "oflcRating": null,
                "pefilmRating": null,
                "rcnofRating": null,
                "resorteviolenciaRating": null,
                "rtcRating": null,
                "rteRating": null,
                "russiaRating": null,
                "skfilmRating": null,
                "smaisRating": null,
                "smsaRating": null,
                "tvpgRating": null,
                "ytRating": null
                }
            },
            "status": {
                "embeddable": true,
                "failureReason": null,
                "license": "youtube",
                "madeForKids": false,
                "privacyStatus": "public",
                "publicStatsViewable": true,
                "publishAt": null,
                "rejectionReason": null,
                "selfDeclaredMadeForKids": null,
                "uploadStatus": "processed"
            },
            "statistics": {
                "commentCount": "24220",
                "dislikeCount": "1383",
                "favoriteCount": "0",
                "likeCount": "383619",
                "viewCount": "3741389"
            },
            "player": {
                "embedHeight": null,
                "embedHtml": "<iframe width=\"480\" height=\"270\" src=\"//www.youtube.com/embed/JeGhUESd_1o\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>",
                "embedWidth": null
            },
            "topicDetails": {
                "relevantTopicIds": [
                "/m/04rlf",
                "/m/028sqc",
                "/m/028sqc",
                "/m/04rlf"
                ],
                "topicCategories": [
                "https://en.wikipedia.org/wiki/Music_of_Asia",
                "https://en.wikipedia.org/wiki/Music"
                ],
                "topicIds": null
            },
            "recordingDetails": {
                "locationDescription": null,
                "recordingDate": null
            },
            "liveStreamingDetails": {
                "activeLiveChatId": null,
                "actualEndTime": "2020-11-06T04:05:29Z",
                "actualStartTime": "2020-11-06T04:00:09Z",
                "concurrentViewers": null,
                "scheduledEndTime": null,
                "scheduledStartTime": "2020-11-06T04:00:00Z"
            }
            }
        ],
        "pageInfo": {
            "resultsPerPage": 1,
            "totalResults": 1
        }
        }
        JSONDATA;

        return json_decode($youtubeVideoJsonApiData, true)["items"][0];
    }
}
