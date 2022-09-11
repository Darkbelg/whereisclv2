<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Filament\Resources\VideoResource;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;

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
            ]);
    }
}
