<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationGroup = 'Enquiries';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Seminars & mock tests';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\Select::make('type')->required()->default('seminar')
                    ->options(['seminar' => 'Seminar', 'mock_test' => 'Mock test']),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
                Forms\Components\DateTimePicker::make('starts_at')->seconds(false)
                    ->helperText('Leave blank for an always-available mock test.'),
                Forms\Components\TextInput::make('venue'),
                Forms\Components\TextInput::make('seats')->numeric(),
                Forms\Components\Toggle::make('is_free')->default(true),
                Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('starts_at')->dateTime('d M Y, g:i a')->placeholder('Any time')
                    ->color(fn ($record) => $record->starts_at && $record->starts_at->isPast() ? 'danger' : null),
                Tables\Columns\TextColumn::make('registrations_count')->counts('registrations')->label('Registered'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options(['seminar' => 'Seminar', 'mock_test' => 'Mock test']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('starts_at');
    }

    public static function getRelations(): array
    {
        return [
            EventResource\RelationManagers\RegistrationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
