<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionEmail;
use App\Services\SubscriptionEmailService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SuscriptionEmailController extends Controller
{
    use ResponseTrait;

    public function __construct(private readonly SubscriptionEmailService $subscriptionEmailService)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(data: $this->subscriptionEmailService->getAll());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscription_emails,email',
        ]);
        $data = $this->subscriptionEmailService->save($request->all());
        $data->sendEmailVerificationNotification();

        return $this->sendResponse(data: $this->subscriptionEmailService->getById($data->id), message: 'Email suscrito correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function verify()
    {
        $token = request()->get('token');
        $verified = $this->subscriptionEmailService->verify($token);
        $route = $verified ? 'suscrito' : 'no-suscrito';
        return view('welcome', compact('route'));
    }
    public function unVerify()
    {
        $token = request()->get('token');
        $verified = $this->subscriptionEmailService->unVerify($token);
        $route = 'suscripcion-cancelada';
        return view('welcome', compact('route'));
    }
}
