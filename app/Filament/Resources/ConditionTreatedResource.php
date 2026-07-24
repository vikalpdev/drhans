<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ConditionTreatedResource\Pages;
use App\Models\ConditionTreated;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ConditionTreatedResource extends Resource
{
    protected static ?string $model = ConditionTreated::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Medical Content';

    protected static ?string $navigationLabel = 'Conditions Treated';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero section')
                    ->description('Title, subtitle and image shown at the top of the page.')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('summary')
                            ->label('Subtitle')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image')
                            ->label('Hero image')
                            ->collection('hero_image')
                            ->image()
                            ->imageEditor()
                            ->panelLayout('compact')
                            ->imagePreviewHeight('120')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('category')
                            ->options(ConditionTreated::CATEGORIES)
                            ->required(),
                        Forms\Components\TextInput::make('icon')->maxLength(255),
                        Forms\Components\TextInput::make('order')->required()->numeric()->default(0),
                        Forms\Components\Toggle::make('show_in_menu')
                            ->label('Show in Navigation Menu')
                            ->helperText('Turn off to hide from the header mega menu while keeping the page itself accessible.')
                            ->default(true),
                        TinyEditor::make('overview')
                            ->profile('medical')
                            ->minHeight(120)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Detail page content')
                    ->schema([
                        Forms\Components\TagsInput::make('symptoms')->columnSpanFull(),
                        Forms\Components\TagsInput::make('causes')->columnSpanFull(),
                        Forms\Components\TagsInput::make('diagnosis')->columnSpanFull(),
                        Forms\Components\TagsInput::make('treatment_options')->columnSpanFull(),
                        TinyEditor::make('prevention')
                            ->profile('medical')
                            ->minHeight(120)
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('when_to_see_doctor')->columnSpanFull(),
                        TinyEditor::make('why_choose_us')
                            ->profile('medical')
                            ->minHeight(120)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('faqs')
                            ->schema([
                                Forms\Components\TextInput::make('question')->required(),
                                Forms\Components\Textarea::make('answer')->required(),
                            ])
                            ->columnSpanFull()
                            ->addActionLabel('Add FAQ')
                            ->reorderable()
                            ->collapsible(),
                    ])
                    ->collapsible(),
                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')->maxLength(255),
                        Forms\Components\TextInput::make('meta_description')->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsible(),
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
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => ConditionTreated::CATEGORIES[$state] ?? $state),
                Tables\Columns\TextColumn::make('summary')->limit(50),
                Tables\Columns\ToggleColumn::make('show_in_menu')->label('In Menu'),
                Tables\Columns\TextColumn::make('order')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options(ConditionTreated::CATEGORIES),
                Tables\Filters\TernaryFilter::make('show_in_menu')->label('In Menu'),
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
            'index' => Pages\ListConditionTreateds::route('/'),
            'create' => Pages\CreateConditionTreated::route('/create'),
            'edit' => Pages\EditConditionTreated::route('/{record}/edit'),
        ];
    }
}
