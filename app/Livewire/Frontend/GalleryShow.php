<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Gallery;

class GalleryShow extends Component
{
    public Gallery $gallery;
    public $currentImageIndex = 0;
    public $showModal = false;
    
    public function mount(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }
    
    public function openModal($imageIndex = 0)
    {
        $this->currentImageIndex = $imageIndex;
        $this->showModal = true;
        $this->dispatch('modal-opened');
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->dispatch('modal-closed');
    }
    
    public function nextImage()
    {
        $totalImages = count($this->gallery->images);
        $this->currentImageIndex = ($this->currentImageIndex + 1) % $totalImages;
    }
    
    public function previousImage()
    {
        $totalImages = count($this->gallery->images);
        $this->currentImageIndex = $this->currentImageIndex > 0 
            ? $this->currentImageIndex - 1 
            : $totalImages - 1;
    }
    
    public function goToImage($index)
    {
        $this->currentImageIndex = $index;
    }

    public function render()
    {
        return view('livewire.frontend.gallery.gallery-show');
    }
}