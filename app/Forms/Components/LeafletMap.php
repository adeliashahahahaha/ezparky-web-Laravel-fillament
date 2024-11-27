<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class LeafletMap extends Field
{
    protected string $view = 'forms.components.leaflet-map';

    protected $latitude = 0;
    protected $longitude = 0;
    protected $zoom = 13;
    protected $isCreateMode = true;

    public function latitude(string $latitude): static
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function longitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function zoom(int $zoom): static
    {
        $this->zoom = $zoom;
        return $this;
    }

    public function createMode(bool $isCreateMode = true): static
    {
        $this->isCreateMode = $isCreateMode;
        return $this;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getZoom(): int
    {
        return $this->zoom;
    }

    public function isCreateMode(): bool
    {
        return $this->isCreateMode;
    }
}
