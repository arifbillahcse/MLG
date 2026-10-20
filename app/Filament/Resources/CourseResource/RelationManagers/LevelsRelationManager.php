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
                Forms\Components\TextInput::make('months')->numeric()->step(0.5)->label('Duration (months)'),
                Forms\Components\TextInput::make('classes')->numeric()->label('Number of classes'),
                Forms\Components\TextInput::make('days_per_week')->numeric()->minValue(1)->maxValue(7)
                    ->label('Class days per week'),
                Forms\Components\TextInput::make('hours_per_day')->numeric()->step(0.5)
                    ->label('Hours per day'),
                Forms\Components\TextInput::make('vocabulary')->placeholder('~800'),
                Forms\Components\TextInput::make('characters')->label('Kanji / characters')->placeholder('~100'),
                Forms\Components\TextInput::make('fee_before')->numeric()->prefix('৳')
                    ->label('Fee before discount')
                    ->helperText('Shown struck through beside the real fee. Leave blank when no offer is running.'),
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
                Tables\Columns\TextColumn::make('fee_before')->label('Was')
                    ->formatStateUsing(fn ($state) => filled($state) ? '৳'.number_format((float) $state) : '—')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('fee_in_class')->label('In class')
                    ->formatStateUsing(fn ($state) => filled($state) ? '৳'.number_format((float) $state) : '—'),
                Tables\Columns\TextColumn::make('fee_online')->label('Online')
                    ->formatStateUsing(fn ($state) => filled($state) ? '৳'.number_format((float) $state) : '—'),
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
