<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * Represents HTTP 401 Unauthorized responses.
 *
 * This response should be used when the client is not authenticated
 * or provides invalid authentication credentials.
 */
class UnauthorizedResponse extends FailureResponse
{
	/**
	 * Create a new unauthorized response instance.
	 *
	 * @param string $message The response message.
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(Response::HTTP_UNAUTHORIZED, $message, $errors);
	}

	/**
	 * Return a response for invalid login credentials.
	 */
	public static function invalidCredentials()
	{
		return (new self(__('bersiv-api-response::auths.failures.incorrect_credentials')))->send();
	}

	/**
	 * Return a response for unauthenticated access.
	 */
	public static function unauthenticated()
	{
		return (new self(__('bersiv-api-response::auths.failures.invalid_token')))->send();
	}
}
