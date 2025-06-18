<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('bio'),
                Forms\Components\FileUpload::make('avatar')
                    ->image()
                    ->directory('authors')
                    ->deleteUploadedFileUsing(function ($file) {
                        // Hapus file ketika dihapus dari form
                        if (Storage::disk('public')->exists($file)) {
                            return Storage::disk('public')->delete($file);
                        }
                        return true;
                    }),
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\TextInput::make('website')->url(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('articles_count')->counts('articles'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Author $record) {
                        // Hapus avatar sebelum record dihapus
                        if (!empty($record->avatar) && Storage::disk('public')->exists($record->avatar)) {
                            Storage::disk('public')->delete($record->avatar);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Collection $records) {
                            // Hapus avatar sebelum records dihapus (bulk delete)
                            foreach ($records as $record) {
                                if (!empty($record->avatar) && Storage::disk('public')->exists($record->avatar)) {
                                    Storage::disk('public')->delete($record->avatar);
                                }
                            }
                        }),
                ]),
            ])
            ->headerActions([
            ]);
    }

    /**
     * Clean orphaned author avatars
     */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}