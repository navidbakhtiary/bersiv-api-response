<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;

/**
 * Handles range-related success responses.
 *
 * This action is intended for endpoints that return range-based data,
 * such as attribute ranges or date ranges.
 *
 * Response behavior:
 * - returns 200 OK with a filled-range message when data exists
 * - returns 200 OK with an empty-range message when no data exists
 */
class RangesResponseAction
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
        $message = Utilities::collectionHasItems($ranges)
            ? __('bersiv-api-response::messages.successful.attributes_ranges_retrieved', ['model' => $model_name])
            : __('bersiv-api-response::messages.successful.empty_attributes_ranges', ['model' => $model_name]);

        return (new OkResponse($message, $ranges))->send();
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
        $message = Utilities::collectionHasItems($date_range_resource)
            ? __('bersiv-api-response::messages.successful.date_range_retrieved', ['model' => $model_name])
            : __('bersiv-api-response::messages.successful.empty_date_range', ['model' => $model_name]);

        return (new OkResponse($message, $date_range_resource))->send();
    }
}
