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
 * - invalid login credentials
 * - unauthenticated requests
 * - successful logout
 * - valid token confirmation
 */
class AuthenticationResponseAction
{
	/**
	 * Return an unauthorized response for invalid login credentials.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidLoginCredentials(array|JsonResource $errors = []): JsonResponse
	{
		return UnauthorizedResponse::invalidLoginCredentials($errors);
	}

	/**
	 * Return an unauthorized response when the provided token is invalid.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidToken(array|JsonResource $errors = []): JsonResponse
	{
		return UnauthorizedResponse::invalidToken($errors);
	}

	/**
	 * Return a success response for a completed login operation.
	 *
	 * @param array|JsonResource $data The login response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function login(array|JsonResource $data = []): JsonResponse
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
	 * @param array|JsonResource $data Optional logout response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function logout(array|JsonResource $data = []): JsonResponse
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
	 * @param array|JsonResource $data Optional token validation response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function tokenValid(array|JsonResource $data = []): JsonResponse
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
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function unauthenticated(array|JsonResource $errors = []): JsonResponse
	{
		return UnauthorizedResponse::unauthenticated($errors);
	}
}
