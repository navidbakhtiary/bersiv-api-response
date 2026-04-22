<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\Data;

use Illuminate\Http\JsonResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;

/**
 * Handles value-list success responses.
 *
 * This action is intended for endpoints that return possible values
 * for a specific attribute of a model or entity.
 *
 * Response behavior:
 * - returns 200 OK with a filled-values message when values exist
 * - returns 200 OK with an empty-values message when no values exist
 */
class ValuesResponseAction
{
	/**
	 * Return a response for a list of attribute values.
	 *
	 * @param string $model_name The entity/model display name used in messages.
	 * @param string $attribute The attribute name used in messages.
	 * @param array $values The list of values for the given attribute.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function handle(string $model_name, string $attribute, array $values): JsonResponse
	{
		$message = count($values) > 0
			? __('bersiv-api-response::messages.successful.values_list_retrieved', [
				'model' => $model_name,
				'attribute' => $attribute,
			])
			: __('bersiv-api-response::messages.successful.empty_values_list', [
				'model' => $model_name,
				'attribute' => $attribute,
			]);

		return (new OkResponse($message, $values))->send();
	}
}
