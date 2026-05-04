<?php

namespace NBDev\BersivApiResponse\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Helpers\Utilities;
use NBDev\BersivApiResponse\Responses\Failures\NotFoundResponse;
use NBDev\BersivApiResponse\Responses\Successes\OkResponse;

/**
 * Handles detail responses for single-resource endpoints.
 *
 * This action is intended for endpoints that return one specific entity,
 * such as a user, product, post, or similar single record.
 *
 * Response behavior:
 * - returns 200 OK when the entity exists
 * - returns 404 Not Found when the entity is missing
 */
class DetailResponseAction
{
    /**
     * Return a detail response for a single entity.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  array|JsonResource  $model_resource  The resolved resource data or null.
     * @return JsonResponse The formatted JSON response.
     */
    public function handle(string $model_name, array|JsonResource $model_resource = []): JsonResponse
    {
        if (Utilities::isResourceEmpty($model_resource)) {
            return (
                new NotFoundResponse(
                    __('bersiv-api-response::messages.failures.entity_not_found', [
                        'entity' => $model_name,
                    ]),
                )
            )->send();
        }

        return (
            new OkResponse(
                __('bersiv-api-response::messages.successful.model_found', ['model' => $model_name]),
                $model_resource
            )
        )->send();
    }
}
