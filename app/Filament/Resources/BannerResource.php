<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Content Management';

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
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '21:9',
                                    ])
                                    ->required()
                                    ->columnSpan(2),

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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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