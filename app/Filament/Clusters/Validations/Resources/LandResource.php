<?php

namespace App\Filament\Clusters\Validations\Resources;

use App\Filament\Clusters\Validations;
use App\Filament\Clusters\Validations\Resources\LandResource\Pages;
use App\Filament\Clusters\Validations\Resources\LandResource\RelationManagers;
use App\Forms\Components\LeafletMap;
use App\Infolists\Components\LeaflapMapEntry;
use App\Models\Jukir;
use App\Models\Land;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Components;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandResource extends Resource
{
    protected static ?string $model = Land::class;

    protected static ?string $cluster = Validations::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationParentItem = 'Validations';

    protected static ?int $navigationSort = 1;

    protected static ?string $label = 'Lahan';

    protected static ?string $breadcrumb = 'Lahan';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Lahan')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pemmilik')
                            ->required(),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required(),
                        Forms\Components\DatePicker::make('dob')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('Alamat Lokasi')
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->label('Jenis Lahan')
                            ->options([
                                'private' => 'Kepemilikan Pribadi',
                                'public' => 'Fasilitas Umum',
                            ]),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->required(),
                        Forms\Components\TextInput::make('size')
                            ->label('Ukuran Lahan')
                            ->numeric()
                            ->required(),
                        Forms\Components\Select::make('land_status')
                            ->label('Status Kepemilikan')
                            ->options([
                                'property_right' => 'Hak Milik',
                                'monthly_rent' => 'Sewa Bulanan',
                                'yearly_rent' => 'Sewa Tahunan'
                            ]),
                        Forms\Components\TextInput::make('car_capacity')
                            ->numeric()
                            ->label('Kapasitas Mobil'),
                        Forms\Components\TextInput::make('motor_capacity')
                            ->numeric()
                            ->label('Kapasitas Sepeda Motor'),
                        Forms\Components\TextInput::make('bicycle_capacity')
                            ->numeric()
                            ->label('Kapasitas Sepeda'),
                        Forms\Components\TextInput::make('latitude')
                            ->label('Latitude'),
                        Forms\Components\TextInput::make('longitude')
                            ->label('Longitude'),
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto Lahan')
                            ->disk('public')
                            ->directory('land-photos')
                            ->image(),
                        SpatieMediaLibraryFileUpload::make('media')
                            ->label('Dokumen Tambahan')
                            ->collection('documents-land')
                            ->multiple()
                            ->maxFiles(5)
                    ])->columns(2)
                    ->columnSpan(['lg' => fn(?Land $record) => $record === null ? 3 : 2]),
                // LeafletMap::make('location')
                //     ->label('Lokasi Lahan')
                //     ->latitude($record->location['latitude'] ?? -6.200000)
                //     ->longitude($record->location['longitude'] ?? 106.816666)
                //     ->createMode(true)
                //     ->zoom(13)
                //     ->columnSpan(['lg' => 3]),

                Forms\Components\Section::make()
                    ->schema([
                        Checkbox::make('terms_of_service_2')
                            ->label('Saya Mengakui bahwa mengisi formulir ini dengan kesadaran penuh tanpa adanya paksaan dari pihak manapun')
                            ->accepted(),
                        Checkbox::make('terms_of_service')
                            ->label('Saya setuju dengan segala ketentuan yang berlaku')
                            ->accepted()
                    ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'waiting' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infoList(Infolist $infolist): Infolist
    {
        $land = $infolist->getRecord('Land'); // Adjust this based on how your records are managed

        $latitude = $land->latitude;
        $longitude = $land->longitude;

        return $infolist
            ->schema([
                Components\Section::make('Identitas Pribadi')
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('name')
                                            ->label('Nama'),
                                        Components\TextEntry::make('nik')
                                            ->label('NIK / KK'),
                                        Components\TextEntry::make('dob')
                                            ->date()
                                            ->label('Tanggal Lahir'),


                                    ]),
                                    Components\Group::make([
                                        Components\TextEntry::make('address')
                                            ->label('Alamat Domisili'),
                                        Components\TextEntry::make('phone')
                                            ->label('Nomor Telepon'),
                                        Components\TextEntry::make('status')
                                            ->label('Status')
                                            ->badge()
                                            ->color(fn(string $state): string => match ($state) {
                                                'waiting' => 'warning',
                                                'accepted' => 'success',
                                                'rejected' => 'danger',
                                            })
                                    ]),
                                ]),
                            ImageEntry::make('photo')
                                ->disk('public')
                                ->hiddenLabel()
                                ->columnSpan(['lg' => 4])
                                ->grow(false),
                        ])
                    ]),
                Components\Fieldset::make('Kapasitas Parkir')
                    ->schema([
                        Components\TextEntry::make('car_capacity')
                            ->label('Kapasitas Mobil'),
                        Components\TextEntry::make('motor_capacity')
                            ->label('Kapasitas Sepeda Motor'),
                        Components\TextEntry::make('bicycle_capacity')
                            ->label('Kapasitas Sepeda'),
                    ])->columns(3),
                Components\Section::make('Dokumen Tambahan')
                    ->schema([
                        RepeatableEntry::make('media')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('name')
                                    ->hiddenLabel(),
                                TextEntry::make('file_name')
                                    ->badge()
                                    ->url(fn($record) => $record
                                        ? $record->getUrl()
                                        : '#')
                                    ->hiddenLabel(),
                            ])
                            ->grid(3)
                    ]),
                Components\Section::make('Lokasi Lahan')
                    ->schema([
                        LeaflapMapEntry::make('location')
                            ->latitude($latitude)
                            ->longitude($longitude)
                            ->zoom(13)
                            ->createMode(false)
                            ->columnSpan(['lg' => 3])

                    ])
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLands::route('/'),
            'create' => Pages\CreateLand::route('/create'),
            'edit' => Pages\EditLand::route('/{record}/edit'),
            'view' => Pages\ViewLandr::route('/{record}'),
        ];
    }
}
