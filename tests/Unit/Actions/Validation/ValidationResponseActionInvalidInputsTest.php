<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnprocessableEntityResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValidationResponseActionInvalidInputsTest extends TestCase
{
	public function testInvalidInputsMatchesUnprocessableEntityResponseBuilderWithDefaultMessage(): void
	{
		$action = new ValidationResponseAction();

		$actual_response = $action->invalidInputs();
		$expected_response = UnprocessableEntityResponse::invalidInputs();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testInvalidInputsMatchesUnprocessableEntityResponseBuilderWithCustomMessage(): void
	{
		$action = new ValidationResponseAction();

		$actual_response = $action->invalidInputs('The given data was invalid.');
		$expected_response = UnprocessableEntityResponse::invalidInputs('The given data was invalid.');

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testInvalidInputsReturnsErrorsKey(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidInputsReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testInvalidInputsReturnsGivenArrayErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'email' => ['The email field is required.'],
		];

		$response = $action->invalidInputs(null, $errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
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

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidInputsReturnsDefaultFailureMessageWhenMessageIsNotProvided(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs();

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_inputs'),
			$response_data['message']
		);
	}

	public function testInvalidInputsReturnsCustomFailureMessageWhenMessageIsProvided(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs('The given data was invalid.');

		$response_data = $response->getData(true);

		$this->assertSame('The given data was invalid.', $response_data['message']);
	}

	public function testInvalidInputsReturnsUnprocessableEntityStatusCode(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs();

		$this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
	}

	public function testInvalidInputsReturnsFailureResponseShape(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testInvalidInputsReturnsFailureStatusFlag(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidInputs();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}
}
