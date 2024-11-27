<?php

namespace App\Filament\Clusters\Validations\Resources\LandResource\Pages;

use App\Filament\Clusters\Validations\Resources\LandResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListLands extends ListRecords
{
    protected static string $resource = LandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Lahan'),
        ];
    }
}
