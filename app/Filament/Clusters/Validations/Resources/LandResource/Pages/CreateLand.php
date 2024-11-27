<?php

namespace App\Filament\Clusters\Validations\Resources\LandResource\Pages;

use App\Filament\Clusters\Validations\Resources\LandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateLand extends CreateRecord
{
    protected static string $resource = LandResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Tambah Lahan';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
