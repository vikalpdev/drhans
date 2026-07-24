<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobOpeningResource\Pages;
use App\Models\JobOpening;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobOpeningResource extends Resource
{
    protected static ?string $model = JobOpening::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Site Pages';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\Select::make('department')
                    ->options(JobOpening::DEPARTMENTS)
                    ->required(),
                Forms\Components\TextInput::make('type')->required()->default('Full Time'),
                Forms\Components\TextInput::make('location')->required()->maxLength(255),
                Forms\Components\Toggle::make('is_active')->default(true),
                Forms\Components\Textarea::make('description')->required()->columnSpanFull(),
                Forms\Components\TextInput::make('apply_email')
                    ->label('Apply Now email')
                    ->helperText('Applicants will be directed to email this address. Leave blank to use the general contact page.')
                    ->email()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('department')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => JobOpening::DEPARTMENTS[$state] ?? $state),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')->options(JobOpening::DEPARTMENTS),
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
            'index' => Pages\ListJobOpenings::route('/'),
            'create' => Pages\CreateJobOpening::route('/create'),
            'edit' => Pages\EditJobOpening::route('/{record}/edit'),
        ];
    }
}
