<?php

namespace App\Filament\Widgets;

use App\Models\Enquiry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestEnquiries extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Latest enquiries';

    public function table(Table $table): Table
    {
        return $table
            ->query(Enquiry::query()->latest()->limit(8))
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M, g:i a')->label('Received'),
                Tables\Columns\TextColumn::make('name')->weight('bold'),
                Tables\Columns\TextColumn::make('phone')->copyable(),
                Tables\Columns\TextColumn::make('interest')->badge()->color('gray'),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'new' => 'danger',
                        'contacted' => 'warning',
                        'enrolled' => 'success',
                        default => 'gray',
                    }),
            ])
            ->paginated(false);
    }
}
