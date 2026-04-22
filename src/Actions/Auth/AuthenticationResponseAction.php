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
	 * Return a response for incorrect login credentials.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidCredentials(): JsonResponse
	{
		return UnauthorizedResponse::invalidCredentials();
	}

	/**
	 * Return a success response for a completed logout operation.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function logout(): JsonResponse
	{
		return (new OkResponse(__('bersiv-api-response::auths.successful.logout')))->send();
	}

	/**
	 * Return a success response when the provided token is valid.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function tokenValid(): JsonResponse
	{
		return (new OkResponse(__('bersiv-api-response::auths.successful.valid_token')))->send();
	}

	/**
	 * Return a response for requests without valid authentication.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function unauthenticated(): JsonResponse
	{
		return UnauthorizedResponse::unauthenticated();
	}
}
