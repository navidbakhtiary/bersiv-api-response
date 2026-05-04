<?php

namespace NBDev\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait HandlesValidationResponses
{
    /**
     * Return a response for invalid attributes.
     *
     * @param  array  $attributes  The invalid attribute names.
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function invalidAttributes(array $attributes, array|JsonResource $errors = []): JsonResponse
    {
        return $this->validation_response_action->invalidAttributes($attributes, $errors);
    }

    /**
     * Return a response for invalid captcha validation.
     *
     * @param  array|JsonResource  $errors  Optional structured validation errors.
     * @return JsonResponse The formatted JSON response.
     */
    public function invalidCaptcha(array|JsonResource $errors = []): JsonResponse
    {
        return $this->validation_response_action->invalidCaptcha($errors);
    }

    /**
     * Return a response for invalid request inputs.
     *
     * @param  array|JsonResource  $errors  Optional structured validation errors.
     * @return JsonResponse The formatted JSON response.
     */
    public function invalidInputs(array|JsonResource $errors = []): JsonResponse
    {
        return $this->validation_response_action->invalidInputs($errors);
    }
}
