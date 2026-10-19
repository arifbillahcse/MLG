<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Courses';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Course')->columns(2)->schema([
                Forms\Components\TextInput::make('name')->required()->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)
                    ->helperText('Used in the URL: /courses/japanese'),
                Forms\Components\TextInput::make('native_name')->label('Native name')->placeholder('日本語'),
                Forms\Components\TextInput::make('glyph')->maxLength(16)->helperText('Shown on the course card: あ, 한, 中'),
                Forms\Components\TextInput::make('exam_name')->label('Exam')->placeholder('JLPT'),
                Forms\Components\TextInput::make('price_from')->label('Price from (BDT)')->numeric()->prefix('৳'),
                Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            ]),
            Forms\Components\Section::make('Bengali')->collapsed()->columns(2)->schema([
                Forms\Components\TextInput::make('name_bn')->label('Name (বাংলা)'),
                Forms\Components\Textarea::make('description_bn')->label('Description (বাংলা)')->rows(3),
            ]),
            Forms\Components\Section::make('Display')->columns(3)->schema([
                Forms\Components\Toggle::make('is_test_prep')->label('Test preparation')
                    ->helperText('Teal styling instead of red — used for IELTS.'),
                Forms\Components\Toggle::make('offers_online')->default(true),
                Forms\Components\Toggle::make('offers_in_class')->label('Offers in class')->default(true),
                Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
                Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
            ]),
            Forms\Components\Section::make('SEO')->collapsed()->schema([
                Forms\Components\TextInput::make('meta_title'),
                Forms\Components\Textarea::make('meta_description')->rows(2),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('glyph')->label(''),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->weight('bold'),
                Tables\Columns\TextColumn::make('exam_name')->label('Exam')->badge(),
                Tables\Columns\TextColumn::make('levels_count')->counts('levels')->label('Levels'),
                Tables\Columns\TextColumn::make('price_from')->money('BDT')->label('From'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Visible on the site'),
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
            CourseResource\RelationManagers\LevelsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
