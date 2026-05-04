<?php

namespace NavidBakhtiary\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait HandlesDataResponses
{
    /**
     * Return a response for attribute ranges.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  array|JsonResource  $ranges  The attribute range data.
     * @return JsonResponse The formatted JSON response.
     */
    public function attributeRanges(string $model_name, array|JsonResource $ranges = []): JsonResponse
    {
        return $this->ranges_response_action->attributeRanges($model_name, $ranges);
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
        return $this->list_response_action->attributesList($model_name, $attributes);
    }

    /**
     * Return a response for a single entity detail.
     *
     * Returns a success response when the resource exists,
     * otherwise returns a not found response.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  array|JsonResource  $model_resource  The single resource payload.
     * @return JsonResponse The formatted JSON response.
     */
    public function detail(string $model_name, array|JsonResource $model_resource = []): JsonResponse
    {
        return $this->detail_response_action->handle($model_name, $model_resource);
    }

    /**
     * Return a response for date ranges.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  array|JsonResource  $date_range_resource  The date range data.
     * @return JsonResponse The formatted JSON response.
     */
    public function dateRange(string $model_name, array|JsonResource $date_range_resource = []): JsonResponse
    {
        return $this->ranges_response_action->dateRange($model_name, $date_range_resource);
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
        return $this->list_response_action->filteredList($model_name, $attributes, $data_resource);
    }

    /**
     * Return a response for a collection of entities.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  array|JsonResource  $data_resource  The collection resource or array data.
     * @return JsonResponse The formatted JSON response.
     */
    public function list(string $model_name, array|JsonResource $data_resource = []): JsonResponse
    {
        return $this->list_response_action->handle($model_name, $data_resource);
    }

    /**
     * Return a response for search results.
     *
     * @param  string  $query_entity  The searched entity name.
     * @param  array|JsonResource  $data_resource  The collection resource or array data.
     * @return JsonResponse The formatted JSON response.
     */
    public function searchResults(string $query_entity, array|JsonResource $data_resource = []): JsonResponse
    {
        return $this->list_response_action->searchResults($query_entity, $data_resource);
    }

    /**
     * Return a response for a list of attribute values.
     *
     * @param  string  $model_name  The entity/model display name used in messages.
     * @param  string  $attribute  The attribute name used in messages.
     * @param  array|JsonResource  $values  The list of values for the given attribute.
     * @return JsonResponse The formatted JSON response.
     */
    public function valuesList(string $model_name, string $attribute, array|JsonResource $values = []): JsonResponse
    {
        return $this->values_response_action->handle($model_name, $attribute, $values);
    }
}
