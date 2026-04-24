<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnprocessableEntityResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValidationResponseActionInvalidAttributesTest extends TestCase
{
	public function testInvalidAttributesMatchesUnprocessableEntityResponseBuilder(): void
	{
		$action = new ValidationResponseAction();

		$attributes = ['status', 'type'];

		$actual_response = $action->invalidAttributes($attributes);
		$expected_response = UnprocessableEntityResponse::invalidAttributes($attributes);

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testInvalidAttributesReturnsErrorsKey(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidAttributes(['status']);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidAttributesReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidAttributes(['status']);

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testInvalidAttributesReturnsGivenArrayErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'attributes' => ['One or more attributes are invalid.'],
		];

		$response = $action->invalidAttributes(['status'], $errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidAttributesReturnsGivenJsonResourceErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'attributes' => ['One or more attributes are invalid.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->invalidAttributes(['status'], $resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidAttributesReturnsMessageWithFormattedAttributes(): void
	{
		$action = new ValidationResponseAction();

		$attributes = ['status', 'type'];
		$attributes_text = Utilities::createStringFromArray($attributes);

		$response = $action->invalidAttributes($attributes);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_attributes', [
				'attributes' => $attributes_text,
			]),
			$response_data['message']
		);
	}

	public function testInvalidAttributesReturnsUnprocessableEntityStatusCode(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidAttributes(['status']);

		$this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
	}

	public function testInvalidAttributesReturnsFailureResponseShape(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidAttributes(['status']);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testInvalidAttributesReturnsFailureStatusFlag(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidAttributes(['status']);

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}
}
