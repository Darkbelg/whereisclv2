<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThumbnailResource\Pages;
use App\Filament\Resources\ThumbnailResource\RelationManagers;
use App\Models\Thumbnail;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ThumbnailResource extends Resource
{
    protected static ?string $model = Thumbnail::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('video_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('size')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('width')
                    ->required(),
                Forms\Components\TextInput::make('height')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('video_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\TextColumn::make('url'),
                Tables\Columns\TextColumn::make('width'),
                Tables\Columns\TextColumn::make('height'),
            ])
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
            'index' => Pages\ListThumbnails::route('/'),
            'create' => Pages\CreateThumbnail::route('/create'),
            'edit' => Pages\EditThumbnail::route('/{record}/edit'),
        ];
    }
}
