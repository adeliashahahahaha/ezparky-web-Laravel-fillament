<?php

namespace App\Filament\Clusters\Validations\Resources\JukirResource\Pages;

use App\Filament\Clusters\Validations\Resources\JukirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJukirs extends ListRecords
{
    protected static string $resource = JukirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Jukir'),
        ];
    }
}
