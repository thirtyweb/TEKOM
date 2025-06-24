<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Courses'; // Translated
    protected static ?string $modelLabel = 'Course'; // Translated
    protected static ?string $pluralModelLabel = 'Courses'; // Translated
    protected static ?string $navigationGroup = 'Academic'; // Translated

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Course Information') // Translated
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('Course Code') // Translated
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('IPB110A') // Kept as example
                                    ->maxLength(20),
                                
                                Forms\Components\TextInput::make('sks') // Kept as SKS (credit units)
                                    ->label('Credit Units (SKS)') // Translated and added SKS for context
                                    ->required()
                                    ->placeholder('3(2-1)') // Kept as example
                                    ->helperText('Format: Total(Theory-Practice)') // Translated
                                    ->maxLength(10),
                            ]),

                        Forms\Components\TextInput::make('name')
                            ->label('Course Name') // Translated
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('semester')
                                    ->label('Semester') // Translated
                                    ->required()
                                    ->options([
                                        1 => 'Semester 1',
                                        2 => 'Semester 2',
                                        3 => 'Semester 3',
                                        4 => 'Semester 4',
                                        5 => 'Semester 5',
                                        6 => 'Semester 6',
                                        7 => 'Semester 7',
                                        8 => 'Semester 8',
                                    ]),

                                Forms\Components\Select::make('category')
                                    ->label('Category') // Translated
                                    ->required()
                                    ->options([
                                        'PPKU/Common Core Courses' => 'PPKU/Common Core Courses', // Kept specific term
                                        'Mata Kuliah Wajib Program Studi' => 'Program Mandatory Courses', // Translated
                                        'Mata Kuliah Pilihan Program Studi' => 'Program Elective Courses', // Translated
                                        'Mata Kuliah Pilihan Bebas' => 'Free Elective Courses', // Translated
                                        'MBKM' => 'MBKM', // Kept specific term
                                    ])
                                    ->searchable(),
                            ]),

                        Forms\Components\TextInput::make('prerequisite')
                            ->label('Prerequisite Courses') // Translated
                            ->placeholder('IPB110A, KIM1104') // Kept as example
                            ->helperText('Leave empty if no prerequisite') // Translated
                            ->columnSpanFull()
                            ->maxLength(255),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Status') // Translated
                            ->default(true)
                            ->helperText('Inactive courses will not be displayed'), // Translated
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Code') // Translated
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->color('primary'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Course Name') // Translated
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('sks')
                    ->label('SKS') // Kept as SKS
                    ->alignCenter()
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester') // Translated
                    ->alignCenter()
                    ->badge()
                    ->color(fn ($record) => match($record->semester) {
                        1, 2 => 'primary',
                        3, 4 => 'warning',
                        5, 6 => 'success',
                        7, 8 => 'danger',
                        default => 'gray'
                    }),

                Tables\Columns\TextColumn::make('prerequisite')
                    ->label('Prerequisite') // Translated
                    ->limit(30)
                    ->placeholder('None') // Translated
                    ->tooltip(fn ($record) => $record->prerequisite),

                Tables\Columns\TextColumn::make('category')
                    ->label('Category') // Translated
                    ->wrap()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status') // Translated
                    ->boolean()
                    ->alignCenter(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At') // Translated
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('semester')
                    ->label('Semester') // Translated
                    ->options([
                        1 => 'Semester 1',
                        2 => 'Semester 2', 
                        3 => 'Semester 3',
                        4 => 'Semester 4',
                        5 => 'Semester 5',
                        6 => 'Semester 6',
                        7 => 'Semester 7',
                        8 => 'Semester 8',
                    ]),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Category') // Translated
                    ->options([
                        'PPKU/Common Core Courses' => 'PPKU/Common Core Courses', // Kept specific term
                        'Mata Kuliah Wajib Program Studi' => 'Program Mandatory Courses', // Translated
                        'Mata Kuliah Pilihan Program Studi' => 'Program Elective Courses', // Translated
                        'Mata Kuliah Pilihan Bebas' => 'Free Elective Courses', // Translated
                        'MBKM' => 'MBKM', // Kept specific term
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'), // Translated
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate') // Translated
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate') // Translated
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->defaultSort('semester')
            ->striped()
            ->paginated([10, 25, 50]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}