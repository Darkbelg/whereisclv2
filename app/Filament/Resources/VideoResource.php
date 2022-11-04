<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::getTableColumns())
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('channel_id')
                ->disabled(),
            Forms\Components\TextInput::make('id')
                ->required(),
            Forms\Components\TextInput::make('title')
                ->disabled(),
            Forms\Components\Textarea::make('description')
                ->disabled(),
            Forms\Components\TextInput::make('comments')
                ->disabled(),
            Forms\Components\TextInput::make('dislikes')
                ->disabled(),
            Forms\Components\TextInput::make('likes')
                ->disabled(),
            Forms\Components\TextInput::make('views')
                ->disabled(),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('channel_id'),

            Tables\Columns\TextColumn::make('id')
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),

            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime(),

            Tables\Columns\TextColumn::make('published_at')
                ->dateTime(),

            Tables\Columns\TextColumn::make('title')
                ->searchable(),

            Tables\Columns\TextColumn::make('description')
                ->limit(50)
                ->searchable(),

            Tables\Columns\TextColumn::make('comments'),

            Tables\Columns\TextColumn::make('dislikes'),

            Tables\Columns\TextColumn::make('likes'),

            Tables\Columns\TextColumn::make('views'),

        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }
}
