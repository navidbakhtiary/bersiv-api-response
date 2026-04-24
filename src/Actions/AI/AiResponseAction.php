<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\AI;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\NotFoundResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;

/**
 * Handles AI-related responses.
 *
 * This action centralizes response cases for AI-powered features,
 * including successful AI answers and missing AI output.
 */
class AiResponseAction
{
	/**
	 * Return an AI answer response.
	 *
	 * If answer data exists, this returns a successful response.
	 * If answer data is empty, this returns a not-found response.
	 *
	 * @param array|JsonResource|null $data The AI answer payload.
	 * @param array|JsonResource $errors Optional structured error details used when no answer is available.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function answer(array|JsonResource|null $data = null, array|JsonResource $errors = []): JsonResponse
	{
		if (Utilities::isResourceEmpty($data))
		{
			return NotFoundResponse::noAIAnswer($errors);
		}

		return (
			new OkResponse(
				__('bersiv-api-response::messages.successful.ai_answer_generated'),
				$data
			)
		)->send();
	}
}
