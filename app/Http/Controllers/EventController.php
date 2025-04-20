<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use App\Services\SubscriptionEmailService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use ResponseTrait;

    public function __construct(
        private readonly EventService $carouselService,
        private readonly SubscriptionEmailService $subscriptionEmailService
    ) {

    }

    public function index()
    {
        return $this->sendResponse(data: $this->carouselService->getAll());
    }

    public function show(string $slug)
    {
        return $this->sendResponse(data: $this->carouselService->getBySlug($slug));
    }

    public function enroll(Request $request, Event $event)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $suscriptor = $this->subscriptionEmailService->query()->where('email', $request->input('email'))->first();
        if (!$suscriptor) {
            $suscriptor = $this->subscriptionEmailService->save($request->all());
        }
        $suscriptor->events()->syncWithoutDetaching($event);
        return $this->sendResponse(data: $suscriptor, message: 'Suscripcion completada satisfactoriamente');

    }
}
