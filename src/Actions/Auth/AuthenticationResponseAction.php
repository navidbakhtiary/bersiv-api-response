<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnauthorizedResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;

/**
 * Handles authentication-related responses.
 *
 * This action centralizes common authentication response cases such as:
 * - successful login
 * - invalid credentials
 * - unauthenticated requests
 * - successful logout
 * - valid token confirmation
 */
class AuthenticationResponseAction
{
	/**
	 * Return a response for incorrect login credentials.
	 *
	 * @param JsonResource|array $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidLoginCredentials(JsonResource|array $errors = []): JsonResponse
	{
		return UnauthorizedResponse::invalidLoginCredentials($errors);
	}

	/**
	 * Return a success response for a completed login operation.
	 *
	 * @param JsonResource|array $data The login response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function login(JsonResource|array $data = []): JsonResponse
	{
		return (
			new OkResponse(
				__('bersiv-api-response::auths.successful.login'),
				$data
			)
		)->send();
	}

	/**
	 * Return a success response for a completed logout operation.
	 *
	 * @param JsonResource|array $data Optional logout response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function logout(JsonResource|array $data = []): JsonResponse
	{
		return (
			new OkResponse(
				__('bersiv-api-response::auths.successful.logout'),
				$data
			)
		)->send();
	}

	/**
	 * Return a success response when the provided token is valid.
	 *
	 * @param JsonResource|array $data Optional token validation response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function tokenValid(JsonResource|array $data = []): JsonResponse
	{
		return (
			new OkResponse(
				__('bersiv-api-response::auths.successful.valid_token'),
				$data
			)
		)->send();
	}

	/**
	 * Return an unauthorized response for unauthenticated requests.
	 *
	 * @param JsonResource|array $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function unauthenticated(JsonResource|array $errors = []): JsonResponse
	{
		return UnauthorizedResponse::unauthenticated($errors);
	}
}
