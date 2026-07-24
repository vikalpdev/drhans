<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecialistReviewResource\Pages;
use App\Models\SpecialistReview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SpecialistReviewResource extends Resource
{
    protected static ?string $model = SpecialistReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Submissions';

    protected static ?string $navigationLabel = 'Doctor Reviews';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('specialist_id')
                    ->relationship('specialist', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone (for verification, not public)')
                    ->tel()
                    ->maxLength(20),
                Forms\Components\Select::make('rating')
                    ->options([1 => '1 Star', 2 => '2 Stars', 3 => '3 Stars', 4 => '4 Stars', 5 => '5 Stars'])
                    ->required(),
                Forms\Components\Textarea::make('comment')->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->required()
                    ->default('pending'),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('specialist.name')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable()->label('Reviewer'),
                Tables\Columns\TextColumn::make('phone')->label('Phone')->toggleable()->default('—'),
                Tables\Columns\TextColumn::make('rating')
                    ->formatStateUsing(fn (int $state) => str_repeat('★', $state).str_repeat('☆', 5 - $state)),
                Tables\Columns\TextColumn::make('comment')->limit(60)->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state) => match ($state) {
                    'pending' => 'warning',
                    'approved' => 'success',
                    'rejected' => 'danger',
                }),
                Tables\Columns\ToggleColumn::make('is_approved')
                    ->label('Active')
                    ->getStateUsing(fn (SpecialistReview $record) => $record->status === 'approved')
                    ->updateStateUsing(fn (SpecialistReview $record, $state) => $record->update(['status' => $state ? 'approved' : 'rejected'])),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected',
                ]),
                Tables\Filters\SelectFilter::make('specialist_id')
                    ->label('Doctor')
                    ->relationship('specialist', 'name'),
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
            'index' => Pages\ListSpecialistReviews::route('/'),
            'create' => Pages\CreateSpecialistReview::route('/create'),
            'edit' => Pages\EditSpecialistReview::route('/{record}/edit'),
        ];
    }
}
