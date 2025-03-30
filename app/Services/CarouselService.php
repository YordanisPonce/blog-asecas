<?php
namespace App\Services;
use App\Models\Blog;
use App\Models\Carousel;

class CarouselService extends Service
{
    public function __construct()
    {
        $this->record = new Carousel;
    }

}
