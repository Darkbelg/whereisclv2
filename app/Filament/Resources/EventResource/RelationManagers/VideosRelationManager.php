<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Filament\Resources\VideoResource;
use App\Models\Channel;
use App\Service\YoutubeApi;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Contracts\HasRelationshipTable;
use Illuminate\Database\Eloquent\Model;

class VideosRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'videos';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                VideoResource::getFormSchema()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                VideoResource::getTableColumns()
            )
            ->filters([
                //
            ])->headerActions([
                CreateAction::make()
                    ->using(function (HasRelationshipTable $livewire, array $data):Model {
                            $videoMetaData = (new YoutubeApi())->getVideoMetaData($data["id"]);
                            if (!$videoMetaData) {
                                throw new \Exception("Video not found on youtube");
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
                                "id" => $data["id"],
                                "title" => $videoMetaDataSnippet["title"],
                                "description" => $videoMetaDataSnippet["description"],
                                "published_at" => date('Y-m-d h:i:s', strtotime($videoMetaDataSnippet["publishedAt"])),
                                "comments" => $videoMetaDataStatistics["commentCount"] ?: 0,
                                "dislikes" => $videoMetaDataStatistics["dislikeCount"] ?: 0,
                                "likes" => $videoMetaDataStatistics["likeCount"] ?: 0,
                                "views" => $videoMetaDataStatistics["viewCount"] ?: 0
                            ]);

                            $livewire->getRelationship()->attach($video->id);

                            $video->updateTags($videoMetaDataSnippet["tags"])->updateThumbnails($videoMetaDataSnippet["thumbnails"]);

                            return $video;
                        })
            ]);
    }
}
