<?php

namespace NavidBakhtiary\BersivApiResponse;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\DetailResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\RangesResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ValuesResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\ExternalApi\ExternalApiResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;

/**
 * Central manager for Bersiv response actions.
 *
 * This manager acts as the main entry point behind the BersivApiResponse facade.
 * It delegates response generation to specialized action classes grouped by concern,
 * such as data responses, authentication responses, validation responses,
 * and external API responses.
 */
class BersivApiResponseManager
{
	/**
	 * Create a new manager instance.
	 *
	 * @param AuthenticationResponseAction $authentication_response_action Handles authentication-related responses.
	 * @param DetailResponseAction $detail_response_action Handles single-resource detail responses.
	 * @param ListResponseAction $list_response_action Handles list and collection responses.
	 * @param RangesResponseAction $ranges_response_action Handles attribute/date range responses.
	 * @param ValuesResponseAction $values_response_action Handles attribute values responses.
	 * @param ExternalApiResponseAction $external_api_response_action Handles external API failure responses.
	 * @param ValidationResponseAction $validation_response_action Handles validation-related failure responses.
	 */
	public function __construct(
		protected AuthenticationResponseAction $authentication_response_action,
		protected DetailResponseAction $detail_response_action,
		protected ListResponseAction $list_response_action,
		protected RangesResponseAction $ranges_response_action,
		protected ValuesResponseAction $values_response_action,
		protected ExternalApiResponseAction $external_api_response_action,
		protected ValidationResponseAction $validation_response_action,
	)
	{
	}

	/**
	 * Return a response for attribute ranges.
	 *
	 * @param string $model_name The entity/model display name used in messages.
	 * @param array|JsonResource $ranges The attribute range data.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function attributeRanges(string $model_name, array|JsonResource $ranges): JsonResponse
	{
		return $this->ranges_response_action->attributeRanges($model_name, $ranges);
	}

	/**
	 * Return a response for a single entity detail.
	 *
	 * @param string $model_name The entity/model display name used in messages.
	 * @param array|JsonResource|null $model_resource The single resource payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function detail(string $model_name, array|JsonResource|null $model_resource = null): JsonResponse
	{
		return $this->detail_response_action->handle($model_name, $model_resource);
	}

	/**
	 * Return a response for date ranges.
	 *
	 * @param string $model_name The entity/model display name used in messages.
	 * @param array|JsonResource $date_range_resource The date range data.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function dateRange(string $model_name, array|JsonResource $date_range_resource): JsonResponse
	{
		return $this->ranges_response_action->dateRange($model_name, $date_range_resource);
	}

	/**
	 * Return a response when the external API rejects the request.
	 *
	 * @param string|null $message Optional custom message.
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function externalApiRejected(?string $message = null, array|JsonResource $errors = []): JsonResponse
	{
		return $this->external_api_response_action->rejected($message, $errors);
	}

	/**
	 * Return a response when the external API is unavailable.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function externalApiUnavailable(array|JsonResource $errors = []): JsonResponse
	{
		return $this->external_api_response_action->unavailable($errors);
	}

	/**
	 * Return a response for invalid attributes.
	 *
	 * @param array $attributes The invalid attribute names.
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidAttributes(array $attributes, array|JsonResource $errors = []): JsonResponse
	{
		return $this->validation_response_action->invalidAttributes($attributes, $errors);
	}

	/**
	 * Return a response for invalid captcha verification.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidCaptcha(array|JsonResource $errors = []): JsonResponse
	{
		return $this->validation_response_action->invalidCaptcha($errors);
	}

	/**
	 * Return a response for invalid login credentials.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidLoginCredentials(array|JsonResource $errors = []): JsonResponse
	{
		return $this->authentication_response_action->invalidLoginCredentials($errors);
	}

	/**
	 * Return a response for invalid request inputs.
	 *
	 * @param string|null $message Optional custom validation message.
	 * @param array|JsonResource $errors Optional structured validation errors.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidInputs(?string $message = null, array|JsonResource $errors = []): JsonResponse
	{
		return $this->validation_response_action->invalidInputs($message, $errors);
	}

	/**
	 * Return a response for a collection of entities.
	 *
	 * @param string $model_name The entity/model display name used in messages.
	 * @param array|JsonResource $data_resource The collection resource or array data.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function list(string $model_name, array|JsonResource $data_resource): JsonResponse
	{
		return $this->list_response_action->handle($model_name, $data_resource);
	}

	/**
	 * Return a success response for a completed logout operation.
	 *
	 * @param array|JsonResource $data Optional logout response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function logout(array|JsonResource $data = []): JsonResponse
	{
		return $this->authentication_response_action->logout($data);
	}

	/**
	 * Return a response for search results.
	 *
	 * @param string $query_entity The searched entity name.
	 * @param array|JsonResource $data_resource The collection resource or array data.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function searchResults(string $query_entity, array|JsonResource $data_resource): JsonResponse
	{
		return $this->list_response_action->searchResults($query_entity, $data_resource);
	}

	/**
	 * Return a success response when the provided token is valid.
	 *
	 * @param array|JsonResource $data Optional token validation response payload.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function tokenValid(array|JsonResource $data = []): JsonResponse
	{
		return $this->authentication_response_action->tokenValid($data);
	}

	/**
	 * Return a response for unauthenticated access.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function unauthenticated(array|JsonResource $errors = []): JsonResponse
	{
		return $this->authentication_response_action->unauthenticated($errors);
	}

	/**
	 * Return a response for a list of attribute values.
	 *
	 * @param string $model_name The entity/model display name used in messages.
	 * @param string $attribute The attribute name used in messages.
	 * @param array|JsonResource $values The list of values for the given attribute.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function valuesList(string $model_name, string $attribute, array|JsonResource $values = []): JsonResponse
	{
		return $this->values_response_action->handle($model_name, $attribute, $values);
	}
}
