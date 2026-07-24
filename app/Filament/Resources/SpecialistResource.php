<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\SpecialistResource\Pages;
use App\Models\Centre;
use App\Models\Specialist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SpecialistResource extends Resource
{
    protected static ?string $model = Specialist::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Team';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Info')
                    ->description('Name, role and the centres this specialist is attached to.')
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
                        Forms\Components\Select::make('type_id')
                            ->label('Type')
                            ->relationship('type', 'name', fn ($query) => $query->where('is_active', true)->orderBy('order'))
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('designation')->maxLength(255),
                        Forms\Components\TextInput::make('qualifications')->maxLength(255),
                        Forms\Components\TextInput::make('experience_years')->required()->numeric()->default(0),
                        Forms\Components\TextInput::make('procedures_count')->numeric(),
                        Forms\Components\TextInput::make('order')->required()->numeric()->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->helperText('Turn off to remove this profile from every public page (specialist listings, homepage, appointment booking, chatbot) without deleting it.')
                            ->default(true),
                        Forms\Components\Toggle::make('is_chairman'),
                        Forms\Components\Toggle::make('is_founder'),
                        Forms\Components\Select::make('centres')
                            ->relationship('centres', 'name')
                            ->multiple()
                            ->preload()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Photo')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                            ->collection('photo')
                            ->image()
                            ->imageEditor(),
                    ]),
                Forms\Components\Section::make('Profile')
                    ->description('Bio, quote and highlighted expertise shown on the specialist profile page.')
                    ->schema([
                        TinyEditor::make('bio')
                            ->profile('medical')
                            ->minHeight(120)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('quote')->columnSpanFull(),
                        Forms\Components\TagsInput::make('expertise')->columnSpanFull(),
                        Forms\Components\TagsInput::make('interests')->columnSpanFull(),
                        Forms\Components\TagsInput::make('languages')
                            ->label('Languages Spoken')
                            ->placeholder('e.g. English, Hindi')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
                Forms\Components\Section::make('Education & Experience (chairman/founder profile)')
                    ->schema([
                        Forms\Components\Repeater::make('education')
                            ->schema([
                                Forms\Components\TextInput::make('degree')->required(),
                                Forms\Components\TextInput::make('institution')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('experience_timeline')
                            ->schema([
                                Forms\Components\TextInput::make('role')->required(),
                                Forms\Components\TextInput::make('place')->required(),
                                Forms\Components\TextInput::make('period')->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                    ->collection('photo')
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('type.name')->badge()->label('Type'),
                Tables\Columns\TextColumn::make('designation')->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Active'),
                Tables\Columns\IconColumn::make('is_chairman')->boolean(),
                Tables\Columns\TextColumn::make('experience_years')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_id')
                    ->label('Type')
                    ->relationship('type', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSpecialists::route('/'),
            'create' => Pages\CreateSpecialist::route('/create'),
            'edit' => Pages\EditSpecialist::route('/{record}/edit'),
        ];
    }
}
