<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->disabled(), // We disable this so they don't break the routing slug mappings
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                    ])->columns(2),

                // Home Page Fields
                Forms\Components\Section::make('Home Page Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title_prefix')
                            ->label('Hero Title Prefix'),
                        Forms\Components\TagsInput::make('content.hero_animated_words')
                            ->label('Hero Animated Words'),
                        Forms\Components\Textarea::make('content.hero_description')
                            ->label('Hero Description')
                            ->rows(3),
                        
                        Forms\Components\TextInput::make('content.why_choose_title')
                            ->label('Why Choose Us Title'),
                        Forms\Components\Textarea::make('content.why_choose_description')
                            ->label('Why Choose Us Description')
                            ->rows(5),
                            
                        Forms\Components\TextInput::make('content.tech_title')
                            ->label('Technology Section Title'),
                    ])
                    ->visible(fn ($record) => $record?->slug === 'home'),

                // About Us Page Fields
                Forms\Components\Section::make('About Us Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title')
                            ->label('Hero Title'),
                        Forms\Components\Textarea::make('content.hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3),
                        
                        Forms\Components\Textarea::make('content.mission_description')
                            ->label('Mission Statement'),
                        Forms\Components\Textarea::make('content.vision_description')
                            ->label('Vision Statement'),
                            
                        Forms\Components\Textarea::make('content.why_choose_description')
                            ->label('Why Choose Us Summary'),
                    ])
                    ->visible(fn ($record) => $record?->slug === 'about'),

                // Chairman's Desk Page Fields
                Forms\Components\Section::make('Chairman\'s Desk Content')
                    ->schema([
                        Forms\Components\TextInput::make('content.hero_title')
                            ->label('Hero Title'),
                        Forms\Components\Textarea::make('content.hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3),
                        
                        Forms\Components\TextInput::make('content.journey_title')
                            ->label('Journey Title'),
                        Forms\Components\TextInput::make('content.beliefs_title')
                            ->label('Beliefs Title'),
                    ])
                    ->visible(fn ($record) => $record?->slug === 'chairman'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Disable bulk delete for core pages
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
            'index' => Pages\ListPages::route('/'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
