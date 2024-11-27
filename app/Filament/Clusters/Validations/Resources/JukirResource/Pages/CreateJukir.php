<?php

namespace App\Filament\Clusters\Validations\Resources\JukirResource\Pages;

use App\Filament\Clusters\Validations\Resources\JukirResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateJukir extends CreateRecord
{
    protected static string $resource = JukirResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Tambah Juru Pakir';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
