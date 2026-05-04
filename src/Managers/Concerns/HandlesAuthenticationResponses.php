<?php

namespace NBDev\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait HandlesAuthenticationResponses
{
    /**
     * Return a response for invalid login credentials.
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function invalidLoginCredentials(array|JsonResource $errors = []): JsonResponse
    {
        return $this->authentication_response_action->invalidLoginCredentials($errors);
    }

    /**
     * Return an unauthorized response when the provided token is invalid.
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function invalidToken(array|JsonResource $errors = []): JsonResponse
    {
        return $this->authentication_response_action->invalidToken($errors);
    }

    /**
     * Return a success response for a completed login operation.
     *
     * @param  array|JsonResource  $data  The login response payload.
     * @return JsonResponse The formatted JSON response.
     */
    public function login(array|JsonResource $data = []): JsonResponse
    {
        return $this->authentication_response_action->login($data);
    }

    /**
     * Return a success response for a completed logout operation.
     *
     * @param  array|JsonResource  $data  Optional logout response payload.
     * @return JsonResponse The formatted JSON response.
     */
    public function logout(array|JsonResource $data = []): JsonResponse
    {
        return $this->authentication_response_action->logout($data);
    }

    /**
     * Return a success response when the provided token is valid.
     *
     * @param  array|JsonResource  $data  Optional token validation response payload.
     * @return JsonResponse The formatted JSON response.
     */
    public function tokenValid(array|JsonResource $data = []): JsonResponse
    {
        return $this->authentication_response_action->tokenValid($data);
    }

    /**
     * Return a response for unauthenticated access.
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function unauthenticated(array|JsonResource $errors = []): JsonResponse
    {
        return $this->authentication_response_action->unauthenticated($errors);
    }
}
