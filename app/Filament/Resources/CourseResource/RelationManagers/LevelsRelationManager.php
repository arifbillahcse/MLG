<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Models\CourseLevel;
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
                    ->label('Regular price')
                    ->minValue(0)
                    ->rules(['integer', 'min:0'])
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => $set(
                        'final_price', self::finalPrice($get('fee_before'), $get('discount'))
                    ))
                    ->helperText('What the course costs before any offer.'),

                Forms\Components\TextInput::make('discount')->numeric()->prefix('৳')
                    ->label('Discount')
                    ->default(0)
                    ->minValue(0)
                    ->rules([
                        'integer',
                        'min:0',
                        // A discount larger than the price would mean a
                        // negative fee, so it is refused at the form, not
                        // silently clamped where nobody sees it.
                        fn (Forms\Get $get) => function (string $attribute, $value, \Closure $fail) use ($get) {
                            $regular = (int) $get('fee_before');

                            if ($regular > 0 && (int) $value > $regular) {
                                $fail('The discount cannot be larger than the regular price (৳'.number_format($regular).').');
                            }
                        },
                    ])
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => $set(
                        'final_price', self::finalPrice($get('fee_before'), $get('discount'))
                    ))
                    ->helperText('Leave at 0 when no offer is running.'),

                Forms\Components\TextInput::make('final_price')->prefix('৳')
                    ->label('Final price')
                    ->disabled()
                    ->dehydrated(false)          // derived on save, never posted
                    ->formatStateUsing(fn ($state, ?CourseLevel $record) => $record?->final_fee)
                    ->helperText('Regular price minus discount. Calculated — this is what the student pays.'),

                Forms\Components\TextInput::make('fee_online')->numeric()->prefix('৳')
                    ->label('Fee — online')->minValue(0)->rules(['integer', 'min:0'])
                    ->helperText('Leave blank if this level is not sold online.'),
                Forms\Components\TextInput::make('sort')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->label('Visible on the site')->default(true),
            ]),
            Forms\Components\Repeater::make('outcomes')->simple(
                Forms\Components\TextInput::make('item')->required(),
            )->label("What you'll be able to do")->columnSpanFull(),
        ]);
    }

    /** The one place the admin form works out what the student pays. */
    protected static function finalPrice($regular, $discount): ?int
    {
        if (blank($regular)) {
            return null;
        }

        return max(0, (int) $regular - (int) $discount);
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
                Tables\Columns\TextColumn::make('fee_before')->label('Regular')
                    ->formatStateUsing(fn ($state) => filled($state) ? '৳'.number_format((float) $state) : '—')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('discount')->label('Discount')
                    ->formatStateUsing(fn ($state) => (int) $state > 0 ? '− ৳'.number_format((float) $state) : '—')
                    ->color(fn ($state) => (int) $state > 0 ? 'success' : 'gray'),
                Tables\Columns\TextColumn::make('fee_in_class')->label('Final')->weight('bold')
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
