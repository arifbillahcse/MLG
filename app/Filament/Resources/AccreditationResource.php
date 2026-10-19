<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccreditationResource\Pages;
use App\Models\Accreditation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AccreditationResource extends Resource
{
    protected static ?string $model = Accreditation::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Textarea::make('description')->rows(2),
            Forms\Components\TextInput::make('reference')->label('Registration / licence number')
                ->helperText('An accreditation a visitor cannot verify is worth less than one you leave out.'),
            Forms\Components\FileUpload::make('certificate')->directory('accreditations')
                ->helperText('Upload the certificate so the number can be checked.')
                ->maxSize(4096),
            Forms\Components\Section::make('Bengali')->collapsed()->schema([
                Forms\Components\TextInput::make('title_bn')->label('Title (বাংলা)'),
                Forms\Components\Textarea::make('description_bn')->label('Description (বাংলা)')->rows(2),
            ]),
            Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
            Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('reference')->placeholder('Not supplied')
                    ->color(fn ($state) => $state ? null : 'warning'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->filters([

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
            'index' => Pages\ListAccreditations::route('/'),
            'create' => Pages\CreateAccreditation::route('/create'),
            'edit' => Pages\EditAccreditation::route('/{record}/edit'),
        ];
    }
}
