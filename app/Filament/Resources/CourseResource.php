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
    protected static ?string $navigationLabel = 'Courses'; 
    protected static ?string $modelLabel = 'Course'; 
    protected static ?string $pluralModelLabel = 'Courses'; 
    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Course Information') 
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('Course Code') 
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('IPB110A')
                                    ->maxLength(20),
                                
                                Forms\Components\TextInput::make('sks') 
                                    ->label('Credit Units (SKS)') 
                                    ->required()
                                    ->placeholder('3(2-1)')
                                    ->helperText('Format: Total(Theory-Practice)')
                                    ->maxLength(10),
                            ]),

                        Forms\Components\TextInput::make('name')
                            ->label('Course Name') 
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('semester')
                                    ->label('Semester')
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
                                    ->label('Category') 
                                    ->required()
                                    ->options([
                                        'PPKU/Common Core Courses' => 'PPKU/Common Core Courses',
                                        'Mata Kuliah Wajib Program Studi' => 'Program Mandatory Courses',
                                        'Mata Kuliah Pilihan Program Studi' => 'Program Elective Courses', 
                                        'Mata Kuliah Pilihan Bebas' => 'Free Elective Courses',
                                        'MBKM' => 'MBKM', 
                                    ])
                                    ->searchable(),
                            ]),

                        Forms\Components\TextInput::make('prerequisite')
                            ->label('Prerequisite Courses') 
                            ->placeholder('IPB110A, KIM1104') 
                            ->helperText('Leave empty if no prerequisite') 
                            ->columnSpanFull()
                            ->maxLength(255),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Status') 
                            ->default(true)
                            ->helperText('Inactive courses will not be displayed'), 
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Code') 
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->color('primary'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Course Name') 
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('sks')
                    ->label('SKS') 
                    ->alignCenter()
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester') 
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
                    ->label('Prerequisite') 
                    ->limit(30)
                    ->placeholder('None') 
                    ->tooltip(fn ($record) => $record->prerequisite),

                Tables\Columns\TextColumn::make('category')
                    ->label('Category') 
                    ->wrap()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status') 
                    ->boolean()
                    ->alignCenter(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At') 
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('semester')
                    ->label('Semester') 
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
                    ->label('Category') 
                    ->options([
                        'PPKU/Common Core Courses' => 'PPKU/Common Core Courses', 
                        'Mata Kuliah Wajib Program Studi' => 'Program Mandatory Courses', 
                        'Mata Kuliah Pilihan Program Studi' => 'Program Elective Courses', 
                        'Mata Kuliah Pilihan Bebas' => 'Free Elective Courses', 
                        'MBKM' => 'MBKM', 
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'), 
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate') 
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate') 
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