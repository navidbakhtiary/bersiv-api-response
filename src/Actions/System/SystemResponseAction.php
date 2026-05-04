<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\System;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\InternalServerErrorResponse;

/**
 * Handles system-level failure responses.
 *
 * This action is intended for unexpected application errors, server failures,
 * and generic fallback errors that are not tied to a specific domain concern.
 */
class SystemResponseAction
{
    /**
     * Return a default internal server error response.
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function serverError(array|JsonResource $errors = []): JsonResponse
    {
        return (
            new InternalServerErrorResponse(
                __('bersiv-api-response::messages.failures.server_error'),
                $errors
            )
        )->send();
    }
}
