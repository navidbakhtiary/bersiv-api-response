<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Successes;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * Represents HTTP 200 OK success responses.
 *
 * This class only builds a standard successful JSON response.
 * It does not contain action-specific logic such as list, detail,
 * search, or range message selection.
 */
class OkResponse extends SuccessResponse
{
	/**
	 * Create a new OK response instance.
	 *
	 * @param string $message The response message.
	 * @param JsonResource|array $data The response data payload.
	 */
	public function __construct(string $message, JsonResource|array $data = [])
	{
		parent::__construct(Response::HTTP_OK, $message, $data);
	}
}
