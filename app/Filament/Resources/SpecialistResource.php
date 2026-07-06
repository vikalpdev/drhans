<?php

namespace App\Filament\Resources;

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
                        Forms\Components\Select::make('type')
                            ->options([
                                'ent_surgeon' => 'ENT Surgeon',
                                'audiologist' => 'Audiologist',
                                'allied' => 'Allied Specialist',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('designation')->maxLength(255),
                        Forms\Components\TextInput::make('qualifications')->maxLength(255),
                        Forms\Components\TextInput::make('experience_years')->required()->numeric()->default(0),
                        Forms\Components\TextInput::make('procedures_count')->numeric(),
                        Forms\Components\TextInput::make('order')->required()->numeric()->default(0),
                        Forms\Components\Toggle::make('is_chairman'),
                        Forms\Components\Toggle::make('is_founder'),
                        Forms\Components\Select::make('centres')
                            ->relationship('centres', 'name')
                            ->multiple()
                            ->preload()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Profile')
                    ->schema([
                        Forms\Components\Textarea::make('bio')->columnSpanFull(),
                        Forms\Components\Textarea::make('quote')->columnSpanFull(),
                        Forms\Components\TagsInput::make('expertise')->columnSpanFull(),
                        Forms\Components\TagsInput::make('interests')->columnSpanFull(),
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
                Forms\Components\Section::make('Photo')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                            ->collection('photo')
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                    ->collection('photo')
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('designation')->searchable(),
                Tables\Columns\IconColumn::make('is_chairman')->boolean(),
                Tables\Columns\TextColumn::make('experience_years')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options([
                    'ent_surgeon' => 'ENT Surgeon',
                    'audiologist' => 'Audiologist',
                    'allied' => 'Allied Specialist',
                ]),
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
            'index' => Pages\ListSpecialists::route('/'),
            'create' => Pages\CreateSpecialist::route('/create'),
            'edit' => Pages\EditSpecialist::route('/{record}/edit'),
        ];
    }
}
