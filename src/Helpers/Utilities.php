<?php

namespace NavidBakhtiary\BersivApiResponse\Helpers;

use Illuminate\Http\Resources\Json\JsonResource;

class Utilities
{
    /**
     * Determine whether the given collection contains items.
     *
     * This method supports:
     * - JsonResource instances
     * - arrays
     *
     * If the resolved resource contains a top-level "data" key,
     * that nested array is checked as the actual collection payload.
     */
    public static function collectionHasItems(array|JsonResource $data_resource): bool
    {
        if ($data_resource instanceof JsonResource) {
            $data_resource = $data_resource->resolve();
        }

        if (array_key_exists('data', $data_resource) && is_array($data_resource['data'])) {
            $data_resource = $data_resource['data'];
        }

        return count($data_resource) > 0;
    }

    /**
     * Convert an array of values into a human-readable string.
     *
     * Examples:
     * - [] => ''
     * - ['name'] => 'name'
     * - ['name', 'email'] => 'name and email'
     * - ['name', 'email', 'age'] => 'name, email and age'
     *
     * @param  array  $list  The list of values to convert.
     * @return string The formatted string representation of the array.
     */
    public static function createStringFromArray(array $list): string
    {
        $count = count($list);

        if ($count === 0) {
            return '';
        }

        if ($count === 1) {
            return (string) $list[0];
        }

        return implode(', ', array_slice($list, 0, -1)).' and '.end($list);
    }

    /**
     * Determine whether the given single-resource payload is empty.
     *
     * This method supports:
     * - null values
     * - JsonResource instances
     * - arrays
     */
    public static function isResourceEmpty(array|JsonResource|null $model_resource): bool
    {
        if (is_null($model_resource)) {
            return true;
        }

        if ($model_resource instanceof JsonResource) {
            $model_resource = $model_resource->resolve();
        }

        return count($model_resource) === 0;
    }

    /**
     * Determine whether the given single-resource payload contains data.
     *
     * This method supports:
     * - null values
     * - JsonResource instances
     * - arrays
     */
    public static function resourceHasData(array|JsonResource|null $model_resource): bool
    {
        return ! self::isResourceEmpty($model_resource);
    }
}
