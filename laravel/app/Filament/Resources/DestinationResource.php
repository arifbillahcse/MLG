<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DestinationResource\Pages;
use App\Models\Destination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-asia-australia';

    protected static ?string $navigationGroup = 'Study Abroad';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Destination')->columns(2)->schema([
                Forms\Components\TextInput::make('name')->required()->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('flag')->maxLength(16)->helperText('Flag emoji, e.g. 🇯🇵'),
                Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
                Forms\Components\Textarea::make('intro')->rows(3)->columnSpanFull(),
                Forms\Components\Repeater::make('highlights')->simple(
                    Forms\Components\TextInput::make('item')->required(),
                )->label('Card bullet points')->columnSpanFull()->defaultItems(4),
            ]),
            Forms\Components\Section::make('Page content')->collapsed()->schema([
                Forms\Components\Textarea::make('universities')->rows(5)->label('University list'),
                Forms\Components\Textarea::make('application_process')->rows(5),
                Forms\Components\Textarea::make('visa_guidance')->rows(5),
            ]),
            Forms\Components\Section::make('Bengali')->collapsed()->columns(2)->schema([
                Forms\Components\TextInput::make('name_bn')->label('Name (বাংলা)'),
                Forms\Components\Textarea::make('intro_bn')->label('Intro (বাংলা)')->rows(3),
            ]),
            Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('flag')->label(''),
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('scholarships_count')->counts('scholarships')->label('Scholarships'),
                Tables\Columns\TextColumn::make('partners_count')->counts('partners')->label('Partners'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
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
        return [
            DestinationResource\RelationManagers\ScholarshipsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
