<?php

namespace NavidBakhtiary\BersivApiResponse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for accessing Bersiv response actions.
 *
 * @method static \Illuminate\Http\JsonResponse attributeRanges(string $model_name, \Illuminate\Http\Resources\Json\JsonResource|array $ranges)
 * @method static \Illuminate\Http\JsonResponse detail(string $model_name, \Illuminate\Http\Resources\Json\JsonResource|array|null $model_resource)
 * @method static \Illuminate\Http\JsonResponse dateRange(string $model_name, \Illuminate\Http\Resources\Json\JsonResource|array $date_range_resource)
 * @method static \Illuminate\Http\JsonResponse externalApiRejected(?string $message = null, array $errors = [])
 * @method static \Illuminate\Http\JsonResponse externalApiUnavailable()
 * @method static \Illuminate\Http\JsonResponse invalidAttributes(array $attributes)
 * @method static \Illuminate\Http\JsonResponse invalidCaptcha()
 * @method static \Illuminate\Http\JsonResponse invalidCredentials()
 * @method static \Illuminate\Http\JsonResponse invalidInputs(?string $message = null, array $errors = [])
 * @method static \Illuminate\Http\JsonResponse list(string $model_name, \Illuminate\Http\Resources\Json\JsonResource|array $data_resource)
 * @method static \Illuminate\Http\JsonResponse logout()
 * @method static \Illuminate\Http\JsonResponse searchResults(string $model_name, \Illuminate\Http\Resources\Json\JsonResource|array $data_resource)
 * @method static \Illuminate\Http\JsonResponse tokenValid()
 * @method static \Illuminate\Http\JsonResponse unauthenticated()
 * @method static \Illuminate\Http\JsonResponse valuesList(string $model_name, string $attribute, array $values)
 *
 * @see \NavidBakhtiary\BersivApiResponse\BersivResponseManager
 */
class BersivApiResponse extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return 'bersiv-api-response';
	}
}
