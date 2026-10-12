<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacultyResource\Pages;
use App\Models\Faculty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FacultyResource extends Resource
{
    protected static ?string $model = Faculty::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Team';

    protected static ?string $pluralModelLabel = 'team members';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('group')->required()->default('instructor')
                    ->options(['instructor' => 'Instructor', 'counsellor' => 'Counsellor']),
                Forms\Components\TextInput::make('role')->required()->placeholder('Japanese · JLPT'),
                Forms\Components\TextInput::make('credential')->placeholder('JLPT N1 · 6 years in Tokyo'),
                Forms\Components\Select::make('course_id')->relationship('course', 'name')->label('Course')->searchable(),
                Forms\Components\TextInput::make('initials')->maxLength(4)->helperText('Shown if there is no photograph.'),
                Forms\Components\FileUpload::make('photo')->image()->directory('faculty')->imageEditor()->avatar()
                ->maxSize(4096)
                ->imageResizeMode('contain')
                ->imageResizeTargetWidth(1600)
                ->imageResizeUpscale(false),
                Forms\Components\Textarea::make('quote')->rows(2)->label('Teaching philosophy')->columnSpanFull(),
                Forms\Components\Textarea::make('bio')->rows(4)->columnSpanFull(),
                Forms\Components\TextInput::make('sort')->numeric()->default(0)->helperText('Lower numbers appear first.'),
                Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->circular()->label(''),
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('role')->color('gray'),
                Tables\Columns\TextColumn::make('group')->badge(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')->options(['instructor' => 'Instructor', 'counsellor' => 'Counsellor']),
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
            'index' => Pages\ListFaculty::route('/'),
            'create' => Pages\CreateFaculty::route('/create'),
            'edit' => Pages\EditFaculty::route('/{record}/edit'),
        ];
    }
}
