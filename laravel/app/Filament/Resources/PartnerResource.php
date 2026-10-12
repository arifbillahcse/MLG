<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Universities';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Select::make('destination_id')->relationship('destination', 'name')->label('Country'),
            Forms\Components\TextInput::make('url')->url(),
            Forms\Components\FileUpload::make('logo')->image()->directory('partners'),
            Forms\Components\Toggle::make('is_verified')->label('Partnership can be evidenced')
                ->helperText('Only verified institutions appear in the public list.'),
            Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')->label(''),
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('destination.flag')->label(''),
                Tables\Columns\IconColumn::make('is_verified')->boolean()->label('Verified')
                    ->trueColor('success')->falseColor('warning'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_verified')->label('Verified'),
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
