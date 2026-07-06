<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentResource\Pages;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('icon')->maxLength(255),
                        Forms\Components\TextInput::make('order')->required()->numeric()->default(0),
                        Forms\Components\TextInput::make('summary')->required()->columnSpanFull(),
                        Forms\Components\Textarea::make('overview')->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Detail page content')
                    ->schema([
                        Forms\Components\Repeater::make('process_steps')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\TextInput::make('description')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('who_benefits')->columnSpanFull(),
                        Forms\Components\TagsInput::make('why_choose_us')->columnSpanFull(),
                    ])
                    ->collapsible(),
                Forms\Components\Section::make('Hero image')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image')
                            ->collection('hero_image')
                            ->image()
                            ->imageEditor(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('hero_image')
                    ->collection('hero_image')
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('summary')->limit(50),
                Tables\Columns\TextColumn::make('order')->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
