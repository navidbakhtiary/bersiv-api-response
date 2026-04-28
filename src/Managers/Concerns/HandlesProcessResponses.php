<?php

namespace NavidBakhtiary\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Handles process-related facade responses.
 */
trait HandlesProcessResponses
{
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
	public function processAccepted(string $process_name, array|JsonResource $data = []): JsonResponse
	{
		return $this->process_response_action->accepted($process_name, $data);
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
	public function processFinished(string $process_name, array|JsonResource $data = []): JsonResponse
	{
		return $this->process_response_action->finished($process_name, $data);
	}

	/**
	 * Return a response when the requested process cannot be accepted.
	 *
	 * @param string $process_name The display name of the requested process.
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function processRejected(string $process_name, array|JsonResource $errors = []): JsonResponse
	{
		return $this->process_response_action->rejected($process_name, $errors);
	}
}
