<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Responses\ApiResponse;

/**
 * Base class for failure responses.
 *
 * This class ensures that failure responses use the "errors" key.
 */
class FailureResponse extends ApiResponse
{
	/**
	 * Create a new failure response instance.
	 *
	 * @param int $status_code The HTTP status code.
	 * @param string $message The response message.
	 * @param array|JsonResource $errors Optional structured error details.
	 */
	public function __construct(int $status_code, string $message, array|JsonResource $errors = [])
	{
		parent::__construct($status_code, $message, $errors);

		$this->is_successful = false;
		$this->setResponseContent('errors');
	}
}
