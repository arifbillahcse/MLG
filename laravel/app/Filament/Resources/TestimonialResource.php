<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Success Stories';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('student_name')->required(),
                Forms\Components\Select::make('type')->required()->default('written')
                    ->options(['written' => 'Written review', 'video' => 'Video testimonial', 'alumni' => 'Alumni interview']),
                Forms\Components\TextInput::make('meta')->label('Caption')
                    ->placeholder('TOPIK 4 · Kyung Hee University · 2025')->columnSpanFull(),
                Forms\Components\Textarea::make('quote')->rows(4)->columnSpanFull(),
                Forms\Components\TextInput::make('video_url')->url()->label('Video URL')
                    ->visible(fn (Forms\Get $get) => in_array($get('type'), ['video', 'alumni'])),
                Forms\Components\FileUpload::make('thumbnail')->image()->directory('testimonials')->imageEditor()
                ->maxSize(4096)
                ->imageResizeMode('contain')
                ->imageResizeTargetWidth(1600)
                ->imageResizeUpscale(false),
                Forms\Components\TextInput::make('rating')->numeric()->minValue(1)->maxValue(5)->default(5),
                Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
            ]),
            Forms\Components\Toggle::make('consent_given')->label('Student has given permission to publish')
                ->helperText('Nothing appears on the public site without this.')->required(),
            Forms\Components\Toggle::make('is_featured')->label('Feature on the homepage'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student_name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('meta')->color('gray')->limit(40),
                Tables\Columns\IconColumn::make('consent_given')->boolean()->label('Consent')
                    ->trueColor('success')->falseColor('danger'),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options(['written' => 'Written', 'video' => 'Video', 'alumni' => 'Alumni']),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
