<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Services\CarouselService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    use ResponseTrait;

    public function __construct(private readonly CarouselService $carouselService)
    {

    }

    public function index()
    {
        return $this->sendResponse(data: $this->carouselService->getAll());
    }

    public function show(string $slug)
    {
        return $this->sendResponse(data: $this->carouselService->getBySlug($slug));
    }

}
