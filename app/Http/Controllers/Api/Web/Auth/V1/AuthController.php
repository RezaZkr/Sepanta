<?php

namespace App\Http\Controllers\Api\Web\Auth\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\Auth\V1\LoginRequest;
use App\Http\Requests\Api\Web\Auth\V1\RegisterRequest;
use App\Http\Resources\Api\Web\Customer\V1\CustomerResource;
use App\Mail\Web\WelcomeMail;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $customer = Customer::query()
            ->create([
                'name'     => $request->input('name'),
                'email'    => $request->string('email')->trim(),
                'password' => $request->input('password'),
            ]);

        Mail::to($customer->email)->queue(new WelcomeMail($customer));

        return static::sendLoginResponse($customer);

    }

    public function login(LoginRequest $request)
    {
        $customer = Customer::query()
            ->where('email', $request->string('email')->trim())
            ->first();

        if (!$customer || !Hash::check($request->input('password'), $customer->password)) {
            return response()->error(message: trans('general.message.credential_invalid'), status: ResponseAlias::HTTP_UNAUTHORIZED);
        }

        return static::sendLoginResponse($customer);
    }

    public function logout()
    {
        auth('customer')->logout(true);

        return response()->success();
    }

    private function sendLoginResponse($customer)
    {
        $data['token'] = auth('customer')->login($customer);
        $data['token_type'] = "Bearer";
        $data['customer'] = CustomerResource::make($customer);

        return response()->success(data: $data);
    }
}
