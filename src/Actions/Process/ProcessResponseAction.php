<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnprocessableEntityResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\AcceptedResponse;

/**
 * Handles process-related responses.
 *
 * This action is intended for requests that start a process whose final result
 * is not immediately available, such as queued jobs, async imports, reports,
 * AI generation tasks, or background calculations.
 */
class ProcessResponseAction
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
	public function accepted(string $process_name, array|JsonResource $data = []): JsonResponse
	{
		return AcceptedResponse::processingAccepted($process_name, $data);
	}

	/**
	 * Return a response when the requested process cannot be accepted.
	 *
	 * @param string $process_name The display name of the requested process.
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function rejected(string $process_name, array|JsonResource $errors = []): JsonResponse
	{
		return UnprocessableEntityResponse::processRejected($process_name, $errors);
	}
}
