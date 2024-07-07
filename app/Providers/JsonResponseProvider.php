<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class JsonResponseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $response = app(ResponseFactory::class);

        $response->macro('success', function (string $message = null, $data = null, int $status = ResponseAlias::HTTP_OK) use ($response) {

            $responseData = [
                'message' => $message ?? trans('general.message.success'),
                'data' => $data
            ];

            return $response->json($responseData, $status);

        });

        $response->macro('error', function (string $message = null, array $errors = [], int $status = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR) use ($response) {

            $flattenErrors = [];
            array_walk_recursive($errors, function ($error) use (&$flattenErrors) {
                $flattenErrors[] = $error;
            });

            $responseData = [
                'message' => $message ?? trans('general.message.error'),
                'errors' => $flattenErrors,
            ];

            return $response->json($responseData, $status);

        });
    }
}
