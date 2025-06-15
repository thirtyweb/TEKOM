<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Banner;

class Slideshow extends Component
{
    public $allSlides = [];
    public $currentSlide = 0;

    public function mount()
    {
        $banners = Banner::active()->ordered()->get();
        
        // Flatten semua slides dari semua banner jadi satu array
        $this->allSlides = [];
        
        foreach($banners as $banner) {
            if($banner->slides && count($banner->slides) > 0) {
                foreach($banner->slides as $slide) {
                    $this->allSlides[] = [
                        'title' => $slide['title'] ?? $banner->title,
                        'description' => $slide['description'] ?? $banner->description,
                        'image' => $slide['image'] ?? null,
                        'image_url' => isset($slide['image']) ? asset('storage/' . $slide['image']) : null,
                        'link_url' => $slide['link_url'] ?? $banner->link_url,
                        'button_text' => $slide['button_text'] ?? $banner->button_text,
                    ];
                }
            } else {
                // Jika banner tidak punya slides, gunakan data banner sebagai slide
                $this->allSlides[] = [
                    'title' => $banner->title,
                    'description' => $banner->description,
                    'image' => null,
                    'image_url' => null,
                    'link_url' => $banner->link_url,
                    'button_text' => $banner->button_text,
                ];
            }
        }
    }

    public function nextSlide()
    {
        if(count($this->allSlides) > 0) {
            $this->currentSlide = ($this->currentSlide + 1) % count($this->allSlides);
        }
    }

    public function prevSlide()
    {
        if(count($this->allSlides) > 0) {
            $this->currentSlide = $this->currentSlide === 0 
                ? count($this->allSlides) - 1 
                : $this->currentSlide - 1;
        }
    }

    public function goToSlide($index)
    {
        if($index >= 0 && $index < count($this->allSlides)) {
            $this->currentSlide = $index;
        }
    }

    public function render()
    {
        return view('livewire.components.slideshow');
    }
}