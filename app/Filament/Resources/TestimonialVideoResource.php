<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialVideoResource\Pages;
use App\Models\GalleryCategory;
use App\Models\TestimonialVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialVideoResource extends Resource
{
    protected static ?string $model = TestimonialVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('patient_name')->required()->maxLength(255),
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(GalleryCategory::where('type', 'video')->orderBy('order')->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('video_url')->required()->url()->maxLength(255),
                Forms\Components\TextInput::make('order')->required()->numeric()->default(0),
                Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->collection('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail')
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('patient_name')->searchable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->badge(),
                Tables\Columns\TextColumn::make('order')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(GalleryCategory::where('type', 'video')->orderBy('order')->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonialVideos::route('/'),
            'create' => Pages\CreateTestimonialVideo::route('/create'),
            'edit' => Pages\EditTestimonialVideo::route('/{record}/edit'),
        ];
    }
}
