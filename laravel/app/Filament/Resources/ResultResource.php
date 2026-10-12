<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Models\Result;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Success Stories';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Top scores';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('student_name')->required(),
                Forms\Components\Select::make('exam')->required()
                    ->options(['IELTS' => 'IELTS', 'JLPT' => 'JLPT', 'NAT' => 'NAT-TEST', 'TOPIK' => 'TOPIK', 'HSK' => 'HSK']),
                Forms\Components\TextInput::make('score')->required()->helperText('8.0, N4, TOPIK 4, HSK 3 — whatever the exam uses.'),
                Forms\Components\TextInput::make('meta')->label('Caption')->placeholder('First attempt · 2025'),
                Forms\Components\Select::make('course_id')->relationship('course', 'name')->label('Course')->searchable(),
                Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
            ]),
            Forms\Components\Toggle::make('consent_given')->label('Student has given permission to publish')
                ->helperText('Nothing appears on the public site without this.')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam')->badge(),
                Tables\Columns\TextColumn::make('score')->weight('bold'),
                Tables\Columns\TextColumn::make('student_name')->searchable(),
                Tables\Columns\TextColumn::make('meta')->color('gray'),
                Tables\Columns\IconColumn::make('consent_given')->boolean()->label('Consent')
                    ->trueColor('success')->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('exam')->options(['IELTS' => 'IELTS', 'JLPT' => 'JLPT', 'NAT' => 'NAT-TEST', 'TOPIK' => 'TOPIK', 'HSK' => 'HSK']),
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
            'index' => Pages\ListResults::route('/'),
            'create' => Pages\CreateResult::route('/create'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }
}
