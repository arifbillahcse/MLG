<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->columns(2)->schema([
                Forms\Components\TextInput::make('title')->required()->live(onBlur: true)->columnSpanFull()
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Forms\Components\Select::make('post_category_id')->relationship('category', 'name')
                    ->label('Category')->searchable()->preload(),
                Forms\Components\Textarea::make('excerpt')->rows(2)->columnSpanFull(),
                Forms\Components\RichEditor::make('body')->columnSpanFull()
                    ->fileAttachmentsDirectory('posts/attachments'),
            ]),
            Forms\Components\Section::make('Publishing')->columns(3)->schema([
                Forms\Components\FileUpload::make('thumbnail')->image()->directory('posts')->imageEditor()
                ->maxSize(4096)
                ->imageResizeMode('contain')
                ->imageResizeTargetWidth(1600)
                ->imageResizeUpscale(false),
                Forms\Components\TextInput::make('read_minutes')->numeric()->label('Read time (minutes)'),
                Forms\Components\DateTimePicker::make('published_at')->seconds(false)
                    ->helperText('Leave blank to keep it as a draft.'),
                Forms\Components\Toggle::make('is_featured')->label('Featured post'),
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
                Tables\Columns\ImageColumn::make('thumbnail')->label(''),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(50)->weight('bold'),
                Tables\Columns\TextColumn::make('category.name')->badge(),
                Tables\Columns\TextColumn::make('published_at')->dateTime('d M Y')->sortable()
                    ->placeholder('Draft')->color(fn ($state) => $state ? null : 'warning'),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('post_category_id')->relationship('category', 'name')->label('Category'),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
