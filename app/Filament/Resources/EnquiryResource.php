<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnquiryResource\Pages;
use App\Models\Enquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EnquiryResource extends Resource
{
    protected static ?string $model = Enquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = 'Enquiries';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Enquiry')->columns(2)->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('phone')->tel()->required(),
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\TextInput::make('interest'),
                Forms\Components\Textarea::make('message')->rows(4)->columnSpanFull(),
            ]),
            Forms\Components\Section::make('Handling')->columns(2)->schema([
                Forms\Components\Select::make('status')->required()->default('new')
                    ->options(['new' => 'New', 'contacted' => 'Contacted', 'enrolled' => 'Enrolled', 'closed' => 'Closed']),
                Forms\Components\Select::make('assigned_to')->relationship('assignee', 'name')->label('Assigned to'),
                Forms\Components\DateTimePicker::make('contacted_at')->seconds(false),
                Forms\Components\Textarea::make('admin_note')->rows(3)->columnSpanFull()->label('Internal note'),
            ]),
            Forms\Components\Section::make('Source')->collapsed()->columns(2)->schema([
                Forms\Components\TextInput::make('source_form')->disabled(),
                Forms\Components\TextInput::make('source_page')->disabled(),
                Forms\Components\TextInput::make('ip')->disabled(),
                Forms\Components\TextInput::make('created_at')->disabled(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M, g:i a')->sortable()->label('Received'),
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('phone')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('interest')->badge()->color('gray'),
                Tables\Columns\TextColumn::make('source_form')->label('Form')->color('gray')->toggleable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options(['new' => 'New', 'contacted' => 'Contacted', 'enrolled' => 'Enrolled', 'closed' => 'Closed']),
                Tables\Columns\TextColumn::make('assignee.name')->label('Owner')->placeholder('—'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['new' => 'New', 'contacted' => 'Contacted', 'enrolled' => 'Enrolled', 'closed' => 'Closed']),
                Tables\Filters\SelectFilter::make('interest')->options(fn () => \App\Models\Enquiry::query()
                    ->whereNotNull('interest')->distinct()->pluck('interest', 'interest')->all()),
                Tables\Filters\Filter::make('received')->form([
                    Forms\Components\DatePicker::make('from'),
                    Forms\Components\DatePicker::make('until'),
                ])->query(fn ($query, array $data) => $query
                    ->when($data['from'] ?? null, fn ($q, $d) => $q->whereDate('created_at', '>=', $d))
                    ->when($data['until'] ?? null, fn ($q, $d) => $q->whereDate('created_at', '<=', $d))),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('export')
                        ->label('Export to CSV')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->deselectRecordsAfterCompletion()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $columns = ['created_at', 'name', 'phone', 'email', 'interest',
                                        'message', 'source_form', 'source_page', 'status'];

                            return response()->streamDownload(function () use ($records, $columns) {
                                $out = fopen('php://output', 'w');
                                fputcsv($out, $columns);

                                foreach ($records as $record) {
                                    fputcsv($out, array_map(
                                        fn ($c) => (string) $record->{$c},
                                        $columns,
                                    ));
                                }

                                fclose($out);
                            }, 'mlg-enquiries-'.now()->format('Y-m-d').'.csv');
                        }),
                    Tables\Actions\BulkAction::make('markContacted')
                        ->label('Mark as contacted')
                        ->icon('heroicon-o-phone')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records
                            ->each
                            ->update(['status' => 'contacted', 'contacted_at' => now()])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc')->poll('60s');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function canCreate(): bool
    {
        return false;   // enquiries arrive from the public forms
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnquiries::route('/'),
            'edit' => Pages\EditEnquiry::route('/{record}/edit'),
        ];
    }
}
