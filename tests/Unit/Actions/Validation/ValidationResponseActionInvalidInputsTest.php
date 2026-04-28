<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValidationResponseActionInvalidInputsTest extends TestCase
{
	public function testInvalidInputsReturnsDefaultFailureContract(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs();

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_inputs'),
			$response_data['message']
		);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidInputsReturnsCustomFailureMessage(): void
	{
		$action = new ValidationResponseAction();

		$message = 'The given data was invalid.';

		$response = $action->invalidInputs($message);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame($message, $response_data['message']);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidInputsReturnsGivenArrayErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'email' => ['The email field is required.'],
		];

		$response = $action->invalidInputs(null, $errors);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_inputs'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidInputsReturnsGivenJsonResourceErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'email' => ['The email field is required.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->invalidInputs(null, $resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_inputs'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}
}
