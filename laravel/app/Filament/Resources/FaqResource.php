<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'FAQs';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\Select::make('scope')->required()->default('home')->live()
                    ->options(['home' => 'Homepage', 'course' => 'A course page', 'destination' => 'A destination page']),
                Forms\Components\Select::make('course_id')->relationship('course', 'name')->label('Course')
                    ->visible(fn (Forms\Get $get) => $get('scope') === 'course'),
                Forms\Components\Select::make('destination_id')->relationship('destination', 'name')->label('Destination')
                    ->visible(fn (Forms\Get $get) => $get('scope') === 'destination'),
                Forms\Components\TextInput::make('question')->required()->columnSpanFull(),
                Forms\Components\Textarea::make('answer')->required()->rows(4)->columnSpanFull(),
            ]),
            Forms\Components\Section::make('Bengali')->collapsed()->schema([
                Forms\Components\TextInput::make('question_bn')->label('Question (বাংলা)'),
                Forms\Components\Textarea::make('answer_bn')->label('Answer (বাংলা)')->rows(4),
            ]),
            Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
            Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')->searchable()->limit(70)->weight('bold'),
                Tables\Columns\TextColumn::make('scope')->badge(),
                Tables\Columns\TextColumn::make('course.name')->label('Course')->placeholder('—'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('scope')->options(['home' => 'Homepage', 'course' => 'Course', 'destination' => 'Destination']),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
