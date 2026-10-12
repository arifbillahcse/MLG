<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BatchResource\Pages;
use App\Models\Batch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BatchResource extends Resource
{
    protected static ?string $model = Batch::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Courses';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Batch')->columns(2)->schema([
                Forms\Components\Select::make('course_level_id')->relationship('courseLevel', 'code')
                    ->label('Course level')->searchable()->preload(),
                Forms\Components\TextInput::make('title')->required()->placeholder('Morning Batch'),
                Forms\Components\TextInput::make('tag')->placeholder('Japanese N5 · In class')
                    ->helperText('The small label on the card.'),
                Forms\Components\Select::make('mode')->options(['in_class' => 'In class', 'online' => 'Online'])
                    ->default('in_class')->required(),
                Forms\Components\TextInput::make('days')->placeholder('Sat · Mon · Wed'),
                Forms\Components\TextInput::make('time_label')->label('Time')->placeholder('10:00 AM'),
                Forms\Components\TextInput::make('duration_label')->label('Duration')->placeholder('4 months'),
                Forms\Components\DateTimePicker::make('starts_at')->label('Starts')->seconds(false)
                    ->helperText('Leave blank for rolling enrolment. Once this date passes the batch stops showing on the site.'),
            ]),
            Forms\Components\Section::make('Seats')->columns(3)->schema([
                Forms\Components\TextInput::make('seats_total')->numeric()->default(20)->required(),
                Forms\Components\TextInput::make('seats_left')->numeric()->default(20)->required(),
                Forms\Components\Toggle::make('is_featured')->label('Drives the homepage countdown')
                    ->helperText('Only one batch should have this on.'),
                Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
                Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('tag')->color('gray'),
                Tables\Columns\TextColumn::make('mode')->badge()
                    ->color(fn (string $state) => $state === 'online' ? 'success' : 'primary'),
                Tables\Columns\TextColumn::make('starts_at')->dateTime('d M Y, g:i a')->sortable()
                    ->color(fn ($record) => $record->starts_at && $record->starts_at->isPast() ? 'danger' : null)
                    ->description(fn ($record) => $record->starts_at?->isPast() ? 'Passed — hidden from the site' : null),
                Tables\Columns\TextColumn::make('seats_left')->label('Seats left')
                    ->badge()->color(fn ($state) => $state <= 5 ? 'danger' : ($state <= 10 ? 'warning' : 'success')),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Countdown'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('mode')->options(['in_class' => 'In class', 'online' => 'Online']),
                Tables\Filters\TernaryFilter::make('is_active')->label('Visible on the site'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('sort');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBatches::route('/'),
            'create' => Pages\CreateBatch::route('/create'),
            'edit' => Pages\EditBatch::route('/{record}/edit'),
        ];
    }
}
