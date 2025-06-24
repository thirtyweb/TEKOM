<?php

// app/Filament/Resources/AboutUsSectionResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsSectionResource\Pages;
use App\Filament\Resources\AboutUsSectionResource\RelationManagers;
use App\Models\AboutUsSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card; // Opsional, jika ingin pakai Card
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor; // Opsional, jika ingin editor kaya teks
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class AboutUsSectionResource extends Resource
{
    protected static ?string $model = AboutUsSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text'; // Ganti ikon navigasi jika mau
    protected static ?string $modelLabel = 'Halaman Tentang Kami'; // Label di navigasi admin
    protected static ?string $pluralModelLabel = 'Halaman Tentang Kami'; // Plural label

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Tentang Kami (Pengantar)')
                    ->description('Bagian teks deskripsi singkat tentang departemen.')
                    ->schema([
                        Textarea::make('about_us_description')
                            ->label('Deskripsi Sekilas Tentang Kami')
                            ->rows(3)
                            ->maxLength(500)
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(1),

                Section::make('Visi Departemen')
                    ->description('Teks visi utama departemen.')
                    ->schema([
                        Textarea::make('vision_text')
                            ->label('Teks Visi')
                            ->rows(3)
                            ->maxLength(1000)
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(1),

                Section::make('Misi Departemen')
                    ->description('Daftar poin-poin misi. Setiap poin akan ditampilkan sebagai item daftar.')
                    ->schema([
                        Repeater::make('mission_items')
                            ->label('Daftar Misi')
                            ->schema([
                                TextInput::make('mission_point')
                                    ->label('Poin Misi')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->defaultItems(3) // Jumlah item awal saat membuat baru
                            ->grid(1)
                            ->minItems(1)
                            ->maxItems(5) // Batasi jumlah misi jika perlu
                            ->reorderableWithButtons(), // Memungkinkan admin untuk menyusun ulang
                    ])->columns(1),

                Section::make('Fakta & Angka')
                    ->description('Tambahkan fakta-fakta penting dan angkanya. Contoh: "Mahasiswa Aktif" dengan nilai "1,200+".')
                    ->schema([
                        Repeater::make('facts')
                            ->label('Daftar Fakta')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Nama Fakta')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('value')
                                    ->label('Nilai Fakta')
                                    ->required()
                                    ->maxLength(255), // String karena bisa ada "+"
                            ])
                            ->defaultItems(3) // Jumlah item awal saat membuat baru
                            ->minItems(0) // Boleh tidak ada fakta
                            ->grid(2) // Tampilkan label dan value dalam 2 kolom per item
                            ->reorderableWithButtons(), // Memungkinkan admin untuk menyusun ulang
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('about_us_description')
                    ->label('Deskripsi Singkat')
                    ->limit(50), // Batasi teks untuk tampilan tabel
                TextColumn::make('vision_text')
                    ->label('Visi')
                    ->limit(50),
                TextColumn::make('facts')
                    ->label('Jumlah Fakta')
                    ->getStateUsing(fn ($record) => count($record->facts ?? [])) // Menghitung jumlah fakta
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAboutUsSections::route('/'),
            'create' => Pages\CreateAboutUsSection::route('/create'),
            'edit' => Pages\EditAboutUsSection::route('/{record}/edit'),
        ];
    }
}