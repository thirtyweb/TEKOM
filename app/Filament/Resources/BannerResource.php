<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Home Management';

    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Banner Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),

                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->maxLength(500),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Banner Slides')
                    ->schema([
                        Forms\Components\Repeater::make('slides')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),

                                Forms\Components\Textarea::make('description')
                                    ->rows(2)
                                    ->maxLength(500)
                                    ->columnSpan(2),

                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('banners/slides')
                                    ->maxSize(5048) // 2MB dalam KB
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '21:9',
                                    ])
                                    ->required()
                                    ->columnSpan(2)
                                    ->deleteUploadedFileUsing(function ($file) {
                                        // Hapus file ketika dihapus dari form
                                        if (Storage::disk('public')->exists($file)) {
                                            return Storage::disk('public')->delete($file);
                                        }
                                        return true;
                                    }),

                                Forms\Components\TextInput::make('link_url')
                                    ->url()
                                    ->placeholder('https://example.com')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('button_text')
                                    ->placeholder('Learn More')
                                    ->maxLength(255)
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('order')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->maxValue(100)
                                    ->columnSpan(1),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Slide')
                            ->addActionLabel('Add Slide')
                            ->reorderable()
                            ->collapsible()
                            ->cloneable()
                            ->deleteAction(
                                fn (Forms\Components\Actions\Action $action) => $action
                                    ->requiresConfirmation()
                                    ->before(function (array $arguments, Forms\Components\Repeater $component) {
                                        // Hapus gambar ketika slide dihapus
                                        $statePath = $component->getStatePath();
                                        $record = $component->getRecord();
                                        if ($record && isset($arguments['item'])) {
                                            $slides = data_get($record, $statePath, []);
                                            $slideIndex = $arguments['item'];
                                            if (isset($slides[$slideIndex]['image'])) {
                                                $imagePath = $slides[$slideIndex]['image'];
                                                if (Storage::disk('public')->exists($imagePath)) {
                                                    Storage::disk('public')->delete($imagePath);
                                                }
                                            }
                                        }
                                    })
                            )
                            ->minItems(1)
                            ->maxItems(10)
                            ->defaultItems(1),
                    ]),

                Forms\Components\Section::make('Global Link Settings')
                    ->description('These settings will be applied to all slides if individual slides don\'t have their own links')
                    ->schema([
                        Forms\Components\TextInput::make('link_url')
                            ->url()
                            ->placeholder('https://example.com'),

                        Forms\Components\TextInput::make('button_text')
                            ->placeholder('Learn More')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsed(),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),

                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('first_slide_image')
                    ->label('Preview')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) <= 50 ? null : $state;
                    }),

                Tables\Columns\TextColumn::make('slides')
                    ->label('Slides Count')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0)
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Banner $record) {
                        // Hapus semua gambar slides sebelum record dihapus
                        if (!empty($record->slides) && is_array($record->slides)) {
                            foreach ($record->slides as $slide) {
                                if (!empty($slide['image']) && Storage::disk('public')->exists($slide['image'])) {
                                    Storage::disk('public')->delete($slide['image']);
                                }
                            }
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Collection $records) {
                            // Hapus semua gambar slides sebelum records dihapus (bulk delete)
                            foreach ($records as $record) {
                                if (!empty($record->slides) && is_array($record->slides)) {
                                    foreach ($record->slides as $slide) {
                                        if (!empty($slide['image']) && Storage::disk('public')->exists($slide['image'])) {
                                            Storage::disk('public')->delete($slide['image']);
                                        }
                                    }
                                }
                            }
                        }),
                ]),
            ])
            ->headerActions([
               
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order');
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}