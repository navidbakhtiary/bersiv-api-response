<?php

namespace NavidBakhtiary\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait HandlesValidationResponses
{
	/**
	 * Return a response for invalid request inputs.
	 *
	 * @param string|null $message Optional custom validation message.
	 * @param array|JsonResource $errors Optional structured validation errors.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidInputs(?string $message = null, array|JsonResource $errors = []): JsonResponse
	{
		return $this->validation_response_action->invalidInputs($message, $errors);
	}
}
