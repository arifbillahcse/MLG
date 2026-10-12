<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcceptanceLetterResource\Pages;
use App\Models\AcceptanceLetter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AcceptanceLetterResource extends Resource
{
    protected static ?string $model = AcceptanceLetter::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Success Stories';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('university')->required(),
                Forms\Components\Select::make('destination_id')->relationship('destination', 'name')->label('Country'),
                Forms\Components\TextInput::make('intake')->placeholder('April 2025 intake'),
                Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
                Forms\Components\FileUpload::make('image')->image()->directory('letters')->imageEditor()
                    ->helperText('Redact the student name and ID before uploading.')->columnSpanFull()
                ->maxSize(4096)
                ->imageResizeMode('contain')
                ->imageResizeTargetWidth(1600)
                ->imageResizeUpscale(false),
            ]),
            Forms\Components\Toggle::make('consent_given')->label('Student has given permission to publish')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label(''),
                Tables\Columns\TextColumn::make('university')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('destination.flag')->label(''),
                Tables\Columns\TextColumn::make('intake')->color('gray'),
                Tables\Columns\IconColumn::make('consent_given')->boolean()->label('Consent')
                    ->trueColor('success')->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('consent_given')->label('Consent given'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->reorderable('sort')->defaultSort('sort');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcceptanceLetters::route('/'),
            'create' => Pages\CreateAcceptanceLetter::route('/create'),
            'edit' => Pages\EditAcceptanceLetter::route('/{record}/edit'),
        ];
    }
}
