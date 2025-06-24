<?php

namespace App\Livewire\Frontend;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;


#[Title('Courses')] 

class CourseTable extends Component
{
    use WithPagination;

    #[Url(as: 'q')] 
    public $search = '';
    
    #[Url]
    public $semester = '';
    
    #[Url]
    public $category = '';
    
    #[Url]
    public $statusFilter = '';
    
    #[Url]
    public $sortField = 'semester';
    
    #[Url]
    public $sortDirection = 'asc';
    
    #[Url]
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updating($name, $value)
    {
        if (in_array($name, ['semester', 'category', 'statusFilter', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function clearFilters()
    {
        $this->reset(['search', 'semester', 'category', 'statusFilter']);
        $this->resetPage();
    }

    public function render()
    {
        $courses = Course::query()
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('code', 'like', '%' . $this->search . '%')
                      ->orWhere('prerequisite', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->semester, fn ($query) => $query->where('semester', $this->semester))
            ->when($this->category, fn ($query) => $query->where('category', $this->category))
            ->when($this->statusFilter !== '', fn ($query) => $query->where('is_active', $this->statusFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $semesterOptions = [
            1 => 'Semester 1',
            2 => 'Semester 2',
            3 => 'Semester 3',
            4 => 'Semester 4',
            5 => 'Semester 5',
            6 => 'Semester 6',
            7 => 'Semester 7',
            8 => 'Semester 8',
        ];

        $categoryOptions = [
            'PPKU/Common Core Courses' => 'PPKU/Common Core Courses',
            'Mata Kuliah Wajib Program Studi' => 'Mata Kuliah Wajib Program Studi',
            'Mata Kuliah Pilihan Program Studi' => 'Mata Kuliah Pilihan Program Studi',
            'Mata Kuliah Pilihan Bebas' => 'Mata Kuliah Pilihan Bebas',
            'MBKM' => 'MBKM',
        ];

        return view('livewire.frontend.course-table', compact('courses', 'semesterOptions', 'categoryOptions'));
    }
}