<?php

namespace App\Filament\Clusters\Validations\Resources\LandResource\Pages;

use App\Filament\Clusters\Validations\Resources\LandResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewLandr extends ViewRecord
{
    protected static string $resource = LandResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Permohonan Pendaftaran Lahan Baru';
    }

    protected function getActions(): array
    {
        return [
            Action::make('Gagal Wawancara')
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn() => $this->markAsInterviewFailed()),
            Action::make('Lolos Wawancara')
                ->color('success')
                ->requiresConfirmation()
                ->action(fn() => $this->markAsInterviewPassed()),
        ];
    }

    private function markAsInterviewPassed()
    {
        $this->record->update([
            'status' => 'accepted',
        ]);
    }

    private function markAsInterviewFailed()
    {
        $this->record->update([
            'status' => 'rejected',
        ]);
    }
}
