<?php

namespace App\Filament\Clusters\Validations\Resources\JukirResource\Pages;

use App\Filament\Clusters\Validations\Resources\JukirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJukir extends EditRecord
{
    protected static string $resource = JukirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
