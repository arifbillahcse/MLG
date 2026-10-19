<?php

namespace App\Filament\Resources\DestinationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ScholarshipsRelationManager extends RelationManager
{
    protected static string $relationship = 'scholarships';

    protected static ?string $title = 'Scholarships';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->placeholder('MEXT Scholarship'),
            Forms\Components\TextInput::make('short_name')->placeholder('MEXT'),
            Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            Forms\Components\TextInput::make('deadline_note')->columnSpanFull()
                ->helperText('Prose, not a date — deadlines move every year.'),
            Forms\Components\TextInput::make('url')->url()->label('Official link'),
            Forms\Components\TextInput::make('sort')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->weight('bold')->searchable(),
                Tables\Columns\TextColumn::make('short_name')->badge(),
                Tables\Columns\TextColumn::make('deadline_note')->limit(50)->color('gray'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->reorderable('sort')
            ->defaultSort('sort');
    }
}
