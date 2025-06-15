<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Media Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('description')
                    ->rows(3),
                Forms\Components\FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->directory('galleries')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->required()
                    ->helperText('Upload multiple images for this gallery'),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('images')
                    ->label('Images Count')
                    ->formatStateUsing(function ($state) {
                        // Handle different data types safely
                        if (is_array($state)) {
                            return count($state) . ' images';
                        } elseif (is_string($state)) {
                            // Try to decode JSON string
                            $decoded = json_decode($state, true);
                            if (is_array($decoded)) {
                                return count($decoded) . ' images';
                            }
                            return '0 images';
                        }
                        return '0 images';
                    })
                    ->badge()
                    ->color('primary'),
                Tables\Columns\ImageColumn::make('images')
                    ->label('Preview')
                    ->getStateUsing(function ($record) {
                        $images = $record->images;
                        
                        // Handle different data types
                        if (is_string($images)) {
                            $images = json_decode($images, true);
                        }
                        
                        if (is_array($images) && !empty($images)) {
                            return $images[0]; // Return first image for preview
                        }
                        
                        return null;
                    })
                    ->circular()
                    ->size(40),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All galleries')
                    ->trueLabel('Active galleries')
                    ->falseLabel('Inactive galleries'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),        ];
    }
}