<?php

namespace App\Filament\Resources\AcceptanceLetterResource\Pages;

use App\Filament\Resources\AcceptanceLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcceptanceLetters extends ListRecords
{
    protected static string $resource = AcceptanceLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
