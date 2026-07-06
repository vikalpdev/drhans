<?php

namespace App\Filament\Resources;

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

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Conditions Treated';

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
                        Forms\Components\Select::make('category')
                            ->options(ConditionTreated::CATEGORIES)
                            ->required(),
                        Forms\Components\TextInput::make('icon')->maxLength(255),
                        Forms\Components\TextInput::make('order')->required()->numeric()->default(0),
                        Forms\Components\TextInput::make('summary')->required()->columnSpanFull(),
                        Forms\Components\Textarea::make('overview')->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Detail page content')
                    ->schema([
                        Forms\Components\TagsInput::make('symptoms')->columnSpanFull(),
                        Forms\Components\TagsInput::make('causes')->columnSpanFull(),
                        Forms\Components\TagsInput::make('treatment_options')->columnSpanFull(),
                        Forms\Components\TagsInput::make('when_to_see_doctor')->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => ConditionTreated::CATEGORIES[$state] ?? $state),
                Tables\Columns\TextColumn::make('summary')->limit(50),
                Tables\Columns\TextColumn::make('order')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options(ConditionTreated::CATEGORIES),
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
