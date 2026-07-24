<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CentreResource\Pages;
use App\Models\Centre;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class CentreResource extends Resource
{
    protected static ?string $model = Centre::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Locations';

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
                        Forms\Components\TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_general_enquiry')
                            ->label('Phone (General Enquiry)')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_appointment')
                            ->label('Phone (For Appointment)')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('opd_weekday')
                            ->required()
                            ->default('Mon - Sat: 9 AM - 7 PM'),
                        Forms\Components\TextInput::make('opd_sunday')
                            ->required()
                            ->default('Sunday: 10 AM - 2 PM'),
                        Forms\Components\TextInput::make('lat')->numeric(),
                        Forms\Components\TextInput::make('lng')->numeric(),
                        Forms\Components\TagsInput::make('facilities')
                            ->placeholder('Add a facility and press enter')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),
                Forms\Components\Section::make('Photo')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->image()
                            ->imageEditor(),
                    ]),
                Forms\Components\Section::make('Review Platform Links')
                    ->description('Used on the "Share Your Experience" page to direct patients to leave a review for this centre.')
                    ->schema([
                        Forms\Components\TextInput::make('practo_url')->label('Practo Review URL')->url()->maxLength(255),
                        Forms\Components\TextInput::make('justdial_url')->label('Justdial Review URL')->url()->maxLength(255),
                    ])
                    ->columns(2)
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
            ->reorderable('order')
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('city')->searchable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('order')->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCentres::route('/'),
            'create' => Pages\CreateCentre::route('/create'),
            'edit' => Pages\EditCentre::route('/{record}/edit'),
        ];
    }
}
