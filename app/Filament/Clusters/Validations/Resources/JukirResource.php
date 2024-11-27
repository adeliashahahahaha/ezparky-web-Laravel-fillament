<?php

namespace App\Filament\Clusters\Validations\Resources;

use App\Filament\Clusters\Validations;
use App\Filament\Clusters\Validations\Resources\JukirResource\Pages;
use App\Models\Jukir;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs\Tab;
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

class JukirResource extends Resource
{
    protected static ?string $model = Jukir::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Validations::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $breadcrumb = 'Jukir';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),
                        Forms\Components\DatePicker::make('dob')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('Alamat Domisili')
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'pria' => 'Laki-Laki',
                                'wanita' => 'Perempuan'
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->required(),
                        Forms\Components\TextInput::make('religion')
                            ->label('Agama')
                            ->required(),
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto 3 x 4 ')
                            ->disk('public')
                            ->directory('jukir-photo')
                            ->image()
                            ->required(),
                    ])->columns(2)->columnSpan(['lg' => fn(?Jukir $record) => $record === null ? 3 : 2]),
                SpatieMediaLibraryFileUpload::make('media')
                    ->label('Dokumen Tambahan')
                    ->collection('documents-jukirs')
                    ->multiple()
                    ->maxFiles(5)
                    ->columnSpan(3)

            ])
            ->columns(3);
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
                                        Components\TextEntry::make('address')
                                            ->label('Alamat Domisili'),
                                    ]),
                                    Components\Group::make([
                                        Components\TextEntry::make('phone')
                                            ->label('Nomor Telepon'),
                                        Components\TextEntry::make('gender')
                                            ->label('Jenis Kelamin')
                                            ->formatStateUsing(fn(string $state): string => $state === 'pria' ? 'Laki-Laki' : 'Perempuan'),
                                        Components\TextEntry::make('religion')
                                            ->label('Agama'),
                                        Components\TextEntry::make('status')
                                            ->label('Status')
                                            ->badge()
                                            ->color(fn(string $state): string => match ($state) {
                                                'waiting' => 'warning',
                                                'accepted' => 'success',
                                                'rejected' => 'danger',
                                            }),
                                    ]),
                                ]),
                            ImageEntry::make('photo')
                                ->disk('public')
                                ->hiddenLabel()
                                ->circular()
                                ->grow(false),
                        ])
                    ]),
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
            'index' => Pages\ListJukirs::route('/'),
            'create' => Pages\CreateJukir::route('/create'),
            'edit' => Pages\EditJukir::route('/{record}/edit'),
            'view' => Pages\ViewJukir::route('/{record}'),
        ];
    }
}
