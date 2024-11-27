@php
    $statePath = $getStatePath();
    $latitude = $getLatitude();
    $longitude = $getLongitude();
    $isCreateMode = $isCreateMode();
@endphp
<!-- Load Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
<x-dynamic-component :component="$getFieldWrapperView()" :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()"
    :hint="$getHint()" :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$statePath">
    <div wire:ignore x-data="{
        leafletMap: null,
        marker: null,
        isCreateMode: {{ $isCreateMode ? 'true' : 'false' }},
        init() {
            this.$nextTick(() => {

                // Initialize the map with default latitude and longitude
                this.leafletMap = L.map($refs.map).setView([{{ $getState()[$latitude] ?? $getLatitude() }}, {{ $getState()[$longitude] ?? $getLongitude() }}], {{ $getZoom() }});
                // Load OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(this.leafletMap);
                // Add a marker to the map
                this.marker = L.marker([{{ $getState()[$latitude] ?? $getLatitude() }}, {{ $getState()[$longitude] ?? $getLongitude() }}]).addTo(this.leafletMap);
                // If in create mode, allow clicking on the map to move the marker

                if (this.isCreateMode) {
                    this.leafletMap.on('click', (e) => {
                        let lat = e.latlng.lat;
                        let lng = e.latlng.lng;
                        // Update the marker position
                        this.marker.setLatLng([lat, lng]);

                        {{-- console.log({{ $getStatePath() }}); --}}
                        if (lat !== null && lng !== null) {
                            $wire.set('{{ $statePath }}.{{ $latitude }}', lat);
                            $wire.set('{{ $statePath }}.{{ $longitude }}', lng);
                        }
                        // Use $wire to update Livewire component
                        {{-- this.$wire.set('{{ $statePath }}.{{ $latitude }}', lat);
                        this.$wire.set('{{ $statePath }}.{{ $longitude }}', lng); --}}
                    });
                } else {
                    // If not in create mode, set the map view based on existing coordinates
                    this.leafletMap.setView([{{ $getState()[$latitude] ?? $getLatitude() }}, {{ $getState()[$longitude] ?? $getLongitude() }}], {{ $getZoom() }});
                }
            });
        }
    }">
        <!-- The map container needs a height for Leaflet to render properly -->
        <div x-ref="map" style="height: 400px;"></div>
    </div>
</x-dynamic-component>
