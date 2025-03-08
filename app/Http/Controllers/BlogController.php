<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ResponseTrait;
    public function __construct(private readonly BlogService $blogService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(data: $this->blogService->getAll());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return $this->sendResponse(data: $this->blogService->getBySlug($slug));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //
    }
}
