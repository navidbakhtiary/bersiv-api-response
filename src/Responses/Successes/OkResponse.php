<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Successes;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

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
	 * @param array|JsonResource $data Optional response data payload.
	 */
	public function __construct(string $message, array|JsonResource $data = [])
	{
		parent::__construct(JsonResponse::HTTP_OK, $message, $data);
	}

	/**
	 * Return a response for a finished process.
	 *
	 * This response means the requested process has completed successfully
	 * and the result is available.
	 *
	 * @param string $process_name The display name of the requested process.
	 * @param array|JsonResource $data Optional process result payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function processFinished(string $process_name, array|JsonResource $data = []): JsonResponse
	{
		return (
			new self(
				__('bersiv-api-response::messages.successful.process_finished', [
					'process_name' => $process_name,
				]),
				$data
			)
		)->send();
	}
}
