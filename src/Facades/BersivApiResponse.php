<?php

namespace NavidBakhtiary\BersivApiResponse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for accessing Bersiv API response actions.
 *
 * This facade provides semantic response helper methods for common API response
 * purposes such as authentication, validation, data retrieval, AI answers,
 * external API errors, process responses, rate limiting, and system errors.
 *
 * @method static \Illuminate\Http\JsonResponse aiAnswer(array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse attributeRanges(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $ranges = [])
 * @method static \Illuminate\Http\JsonResponse attributesList(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $attributes = [])
 * @method static \Illuminate\Http\JsonResponse dateRange(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $date_range_resource = [])
 * @method static \Illuminate\Http\JsonResponse detail(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $model_resource = [])
 * @method static \Illuminate\Http\JsonResponse externalApiRejected(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse externalApiUnavailable(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse filteredList(string $model_name, string|array $attributes = "", array|\Illuminate\Http\Resources\Json\JsonResource $data_resource = [])
 * @method static \Illuminate\Http\JsonResponse invalidAttributes(array $attributes, array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidCaptcha(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidInputs(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidLoginCredentials(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse invalidToken(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse list(string $model_name, array|\Illuminate\Http\Resources\Json\JsonResource $data_resource = [])
 * @method static \Illuminate\Http\JsonResponse login(array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse logout(array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse processAccepted(string $process_name, array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse processFinished(string $process_name, array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse processRejected(string $process_name, array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse searchResults(string $query_entity, array|\Illuminate\Http\Resources\Json\JsonResource $data_resource = [])
 * @method static \Illuminate\Http\JsonResponse serverError(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
 * @method static \Illuminate\Http\JsonResponse tokenValid(array|\Illuminate\Http\Resources\Json\JsonResource $data = [])
 * @method static \Illuminate\Http\JsonResponse tooManyRequests(array|\Illuminate\Http\Resources\Json\JsonResource $errors = [])
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
