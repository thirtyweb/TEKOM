<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Category;
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

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('excerpt')
                            ->rows(3),
                        Forms\Components\RichEditor::make('content')
                            ->required(),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->directory('articles')
                            ->deleteUploadedFileUsing(function ($file) {
                                // Hapus file ketika dihapus dari form
                                if (Storage::disk('public')->exists($file)) {
                                    return Storage::disk('public')->delete($file);
                                }
                                return true;
                            }),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        Forms\Components\Select::make('author_id')
                            ->relationship('author', 'name')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('published')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                // Auto set published_at when status is published
                                if ($state === 'published' && !$get('published_at')) {
                                    $set('published_at', now());
                                }
                            }),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->default(now()) // Set default value
                            ->label('Publish Date')
                            ->helperText('Leave empty to publish immediately when status is published'),
                        Forms\Components\KeyValue::make('meta_data')
                            ->label('Meta Data')
                            ->keyLabel('Key')
                            ->valueLabel('Value')
                            ->afterStateHydrated(function ($component, $state) {
                                if (is_array($state)) {
                                    $converted = [];
                                    foreach ($state as $key => $value) {
                                        $converted[$key] = is_array($value) ? implode(',', $value) : $value;
                                    }
                                    $component->state($converted);
                                } elseif (is_string($state)) {
                                    $component->state(json_decode($state, true) ?? []);
                                }
                            })
                            ->dehydrateStateUsing(function ($state) {
                                $processed = [];
                                foreach ($state as $key => $value) {
                                    $processed[$key] = $key === 'tags' ? explode(',', $value) : $value;
                                }
                                return $processed;
                            }),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('category.name')->badge(),
                Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('views')->numeric(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('author')
                    ->relationship('author', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Article $record) {
                        // Hapus featured_image sebelum record dihapus
                        if (!empty($record->featured_image) && Storage::disk('public')->exists($record->featured_image)) {
                            Storage::disk('public')->delete($record->featured_image);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Collection $records) {
                            // Hapus featured_image sebelum records dihapus (bulk delete)
                            foreach ($records as $record) {
                                if (!empty($record->featured_image) && Storage::disk('public')->exists($record->featured_image)) {
                                    Storage::disk('public')->delete($record->featured_image);
                                }
                            }
                        }),
                ]),
            ])
            ->headerActions([
            ]);
    }

    /**
     * Clean orphaned article images
     */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}