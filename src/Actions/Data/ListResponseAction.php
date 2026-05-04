<?php

namespace NBDev\BersivApiResponse\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Helpers\Utilities;
use NBDev\BersivApiResponse\Responses\Successes\OkResponse;

/**
 * Handles list responses for collection endpoints.
 *
 * This action is intended for endpoints that return multiple records,
 * such as index, filter, or generic list endpoints.
 *
 * Response behavior:
 * - returns 200 OK with a filled-list message when items exist
 * - returns 200 OK with an empty-list message when no items exist
 */
class ListResponseAction
{
    /**
     * Return a response for a collection of entities.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  array|JsonResource  $data_resource  The collection resource or array data.
     * @return JsonResponse The formatted JSON response.
     */
    public function handle(string $model_name, array|JsonResource $data_resource = []): JsonResponse
    {
        $message = Utilities::collectionHasItems($data_resource)
            ? __('bersiv-api-response::messages.successful.models_list_retrieved', ['model' => $model_name])
            : __('bersiv-api-response::messages.successful.empty_models_list', ['model' => $model_name]);

        return (new OkResponse($message, $data_resource))->send();
    }

    /**
     * Return a response for search results.
     *
     * @param  string  $query_entity  The searched entity name.
     * @param  array|JsonResource  $data_resource  The search result payload.
     * @return JsonResponse The formatted JSON response.
     */
    public function searchResults(string $query_entity, array|JsonResource $data_resource = []): JsonResponse
    {
        $message = Utilities::collectionHasItems($data_resource)
            ? __('bersiv-api-response::messages.successful.searched_query_list_retrieved', ['entity' => $query_entity])
            : __('bersiv-api-response::messages.successful.empty_searched_query_list', ['entity' => $query_entity]);

        return (new OkResponse($message, $data_resource))->send();
    }

    /**
     * Return a response for a filtered list.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  string|array  $attributes  The filter attributes.
     * @param  array|JsonResource  $data_resource  The filtered data payload.
     * @return JsonResponse The formatted JSON response.
     */
    public function filteredList(string $model_name, string|array $attributes = '', array|JsonResource $data_resource = []): JsonResponse
    {
        $attributes_text = is_array($attributes)
            ? Utilities::createStringFromArray($attributes)
            : $attributes;

        $message = Utilities::collectionHasItems($data_resource)
            ? __('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
                'model' => $model_name,
                'attributes' => $attributes_text,
            ])
            : __('bersiv-api-response::messages.successful.empty_filtered_models_list', [
                'model' => $model_name,
                'attributes' => $attributes_text,
            ]);

        return (new OkResponse($message, $data_resource))->send();
    }

    /**
     * Return a response for an attributes list.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  array|JsonResource  $attributes  The list of attributes.
     * @return JsonResponse The formatted JSON response.
     */
    public function attributesList(string $model_name, array|JsonResource $attributes = []): JsonResponse
    {
        $attributes_count = is_array($attributes)
            ? count($attributes)
            : count($attributes->resolve());

        $message = $attributes_count > 0
            ? __('bersiv-api-response::messages.successful.attributes_list_retrieved', ['model' => $model_name])
            : __('bersiv-api-response::messages.successful.empty_attributes_list', ['model' => $model_name]);

        return (new OkResponse($message, $attributes))->send();
    }
}
