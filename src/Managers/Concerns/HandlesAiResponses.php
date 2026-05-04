<?php

namespace NBDev\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Handles AI-related facade responses.
 */
trait HandlesAiResponses
{
    /**
     * Return a response for an AI answer.
     *
     * Returns a success response when answer data is provided,
     * otherwise returns a failure response when no answer is available.
     *
     * @param  array|JsonResource  $data  The AI answer payload.
     * @return JsonResponse The formatted JSON response.
     */
    public function aiAnswer(array|JsonResource $data = []): JsonResponse
    {
        return $this->ai_response_action->answer($data);
    }
}
