<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnprocessableEntityResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\AcceptedResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;

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
		return (
			new AcceptedResponse(
				__('bersiv-api-response::messages.successful.processing_accepted', [
					'name' => $process_name,
				]),
				$data
			)
		)->send();
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
	public function finished(string $process_name, array|JsonResource $data = []): JsonResponse
	{
		return (
			new OkResponse(
				__('bersiv-api-response::messages.successful.process_finished', [
					'name' => $process_name,
				]),
				$data
			)
		)->send();
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
		return (
			new UnprocessableEntityResponse(
				__('bersiv-api-response::messages.failures.process_rejected', [
					'name' => $process_name,
				]),
				$errors
			)
		)->send();
	}
}
