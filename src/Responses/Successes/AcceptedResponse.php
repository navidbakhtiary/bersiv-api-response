<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Successes;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents successful 202 Accepted responses.
 *
 * This response is useful when a request has been accepted for processing,
 * but the final result is not available immediately.
 */
class AcceptedResponse extends SuccessResponse
{
	/**
	 * Create a new accepted response instance.
	 *
	 * @param string $message The response message.
	 * @param array|JsonResource $data Optional response payload.
	 */
	public function __construct(string $message, array|JsonResource $data = [])
	{
		parent::__construct(JsonResponse::HTTP_ACCEPTED, $message, $data);
	}

	/**
	 * Return a response for an accepted background process.
	 *
	 * This response means the request was accepted and processing has started,
	 * but the final result is not ready yet.
	 *
	 * @param string $process_name The display name of the requested process.
	 * @param array|JsonResource $data Optional process payload, such as job_id, status, or tracking data.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function processingAccepted(string $process_name, array|JsonResource $data = []): JsonResponse
	{
		return (
			new self(
				__('bersiv-api-response::messages.successful.processing_accepted', ['process_name' => $process_name]),
				$data
			)
		)->send();
	}
}
