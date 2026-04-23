<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\NotFoundResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;

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
	 * @param string $model_name The entity/model display name used in messages.
	 * @param array|JsonResource|null $model_resource The resolved resource data or null.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function handle(string $model_name, array|JsonResource|null $model_resource = null): JsonResponse
	{
		if (Utilities::isResourceEmpty($model_resource))
		{
			return NotFoundResponse::resourceNotFound($model_name);
		}

		return (
			new OkResponse(
				__('bersiv-api-response::messages.successful.model_found', ['model' => $model_name]),
				$model_resource
			)
		)->send();
	}
}
