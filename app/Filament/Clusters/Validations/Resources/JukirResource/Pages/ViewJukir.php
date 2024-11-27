<?php

namespace App\Filament\Clusters\Validations\Resources\JukirResource\Pages;

use App\Filament\Clusters\Validations\Resources\JukirResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewJukir extends ViewRecord
{
    public function getTitle(): string|Htmlable
    {
        return 'Permohonan Pendaftaran Jukir Baru';
    }


    protected static string $resource = JukirResource::class;

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
