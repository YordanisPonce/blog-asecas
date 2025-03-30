<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Traits\ResponseTrait;

class EventController extends Controller
{
    use ResponseTrait;

    public function __construct(private readonly EventService $carouselService)
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
