<?php

namespace NavidBakhtiary\BersivApiResponse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for accessing Bersiv response actions.
 *
 * @method static \Illuminate\Http\JsonResponse attributeRanges(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $ranges)
 * @method static \Illuminate\Http\JsonResponse detail(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource|null $model_resource = null)
 * @method static \Illuminate\Http\JsonResponse dateRange(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $date_range_resource)
 * @method static \Illuminate\Http\JsonResponse externalApiRejected(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse externalApiUnavailable(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidAttributes(array $attributes, array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidCaptcha(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidInputs(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidLoginCredentials(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse list(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $data_resource)
 * @method static \Illuminate\Http\JsonResponse logout(array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse searchResults(string $query_entity, array|\Illuminate\Http\Resources\Json\JsonResource $data_resource)
 * @method static \Illuminate\Http\JsonResponse tokenValid(array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse unauthenticated(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse valuesList(string $model_name, string $attribute, array|\Illuminate\Http\Resources\Json\JsonResource $values = [])
 *
 * @see \NavidBakhtiary\BersivApiResponse\Managers\BersivApiResponseManager
 */
class BersivApiResponse extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return 'bersiv-api-response';
	}
}
