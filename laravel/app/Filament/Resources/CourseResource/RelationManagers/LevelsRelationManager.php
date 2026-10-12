<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LevelsRelationManager extends RelationManager
{
    protected static string $relationship = 'levels';

    protected static ?string $title = 'Levels';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('code')->required()->placeholder('N5'),
                Forms\Components\TextInput::make('label')->required()->placeholder('Beginner'),
                Forms\Components\TextInput::make('subtitle')->columnSpanFull(),
                Forms\Components\TextInput::make('months')->numeric()->label('Duration (months)'),
                Forms\Components\TextInput::make('classes')->numeric()->label('Number of classes'),
                Forms\Components\TextInput::make('vocabulary')->placeholder('~800'),
                Forms\Components\TextInput::make('characters')->label('Kanji / characters')->placeholder('~100'),
                Forms\Components\TextInput::make('fee_in_class')->numeric()->prefix('৳')->label('Fee — in class'),
                Forms\Components\TextInput::make('fee_online')->numeric()->prefix('৳')->label('Fee — online'),
                Forms\Components\TextInput::make('sort')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
            ]),
            Forms\Components\Repeater::make('outcomes')->simple(
                Forms\Components\TextInput::make('item')->required(),
            )->label("What you'll be able to do")->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('code')->badge()->weight('bold'),
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('months')->suffix(' months'),
                Tables\Columns\TextColumn::make('classes'),
                Tables\Columns\TextColumn::make('fee_in_class')->money('BDT')->label('In class'),
                Tables\Columns\TextColumn::make('fee_online')->money('BDT')->label('Online'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->reorderable('sort')
            ->defaultSort('sort');
    }
}
