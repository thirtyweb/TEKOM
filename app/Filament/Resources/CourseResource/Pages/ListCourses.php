<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Mata Kuliah'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(fn () => \App\Models\Course::count()),
            
            'semester_1' => Tab::make('Semester 1')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('semester', 1))
                ->badge(fn () => \App\Models\Course::where('semester', 1)->count()),
                
            'semester_2' => Tab::make('semester 2')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('semester', 2))
                ->badge(fn () => \App\Models\Course::where('semester', 2)->count()),
                
            'ppku' => Tab::make('PPKU')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('category', 'PPKU/Common Core Courses'))
                ->badge(fn () => \App\Models\Course::where('category', 'PPKU/Common Core Courses')->count()),
                
            'inactive' => Tab::make('Tidak Aktif')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false))
                ->badge(fn () => \App\Models\Course::where('is_active', false)->count())
                ->badgeColor('danger'),
        ];
    }
}