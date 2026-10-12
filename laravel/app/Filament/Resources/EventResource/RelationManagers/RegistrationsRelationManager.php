<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RegistrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    protected static ?string $title = 'Who has registered';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('phone')->tel()->required(),
            Forms\Components\TextInput::make('email')->email(),
            Forms\Components\TextInput::make('interest'),
            Forms\Components\Toggle::make('attended')->label('Attended'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M, g:i a')->label('Registered'),
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('phone')->copyable(),
                Tables\Columns\TextColumn::make('interest')->color('gray'),
                Tables\Columns\IconColumn::make('attended')->boolean(),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->defaultSort('created_at', 'desc');
    }
}
