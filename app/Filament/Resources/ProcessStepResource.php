<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcessStepResource\Pages;
use App\Models\ProcessStep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProcessStepResource extends Resource
{
    protected static ?string $model = ProcessStep::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Study Abroad';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Application process';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('destination_id')->relationship('destination', 'name')
                ->label('Country')->placeholder('All countries')
                ->helperText('Leave blank for a step that applies to every destination.'),
            Forms\Components\TextInput::make('step_label')->required()->placeholder('Step 1'),
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Textarea::make('body')->rows(3),
            Forms\Components\Section::make('Bengali')->collapsed()->schema([
                Forms\Components\TextInput::make('title_bn')->label('Title (বাংলা)'),
                Forms\Components\Textarea::make('body_bn')->label('Body (বাংলা)')->rows(3),
            ]),
            Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('step_label')->label('Step')->badge(),
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('destination.name')->label('Country')->placeholder('All countries'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('destination_id')->relationship('destination', 'name')->label('Country'),
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
            'index' => Pages\ListProcessSteps::route('/'),
            'create' => Pages\CreateProcessStep::route('/create'),
            'edit' => Pages\EditProcessStep::route('/{record}/edit'),
        ];
    }
}
