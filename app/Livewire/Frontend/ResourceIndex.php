<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Resource;
use Livewire\Attributes\Title;


#[Title('Resources')] 
class ResourceIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function downloadResource($resourceId)
    {
        $resource = Resource::findOrFail($resourceId);
        $resource->incrementDownloadCount();
        
        // Redirect to download
        return redirect($resource->download_url ?: asset('storage/' . $resource->file_path));
    }

    public function render()
    {
        $query = Resource::where('is_active', true);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.frontend.resource-index', [
            'resources' => $query->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}

