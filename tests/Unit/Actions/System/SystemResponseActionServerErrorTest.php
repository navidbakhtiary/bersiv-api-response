<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\System;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\System\SystemResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\InternalServerErrorResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class SystemResponseActionServerErrorTest extends TestCase
{
	public function testServerErrorMatchesInternalServerErrorResponseBuilder(): void
	{
		$action = new SystemResponseAction();

		$actual_response = $action->serverError();
		$expected_response = InternalServerErrorResponse::serverError();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testServerErrorReturnsErrorsKey(): void
	{
		$action = new SystemResponseAction();

		$response = $action->serverError();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testServerErrorReturnsFailureResponseShape(): void
	{
		$action = new SystemResponseAction();

		$response = $action->serverError();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testServerErrorReturnsGivenArrayErrors(): void
	{
		$action = new SystemResponseAction();

		$errors = [
			'exception' => ['Unexpected server error.'],
		];

		$response = $action->serverError($errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testServerErrorReturnsGivenJsonResourceErrors(): void
	{
		$action = new SystemResponseAction();

		$errors = [
			'exception' => ['Unexpected server error.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->serverError($resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testServerErrorReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new SystemResponseAction();

		$response = $action->serverError();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testServerErrorReturnsFailureStatusFlag(): void
	{
		$action = new SystemResponseAction();

		$response = $action->serverError();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testServerErrorReturnsInternalServerErrorStatusCode(): void
	{
		$action = new SystemResponseAction();

		$response = $action->serverError();

		$this->assertSame(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
	}
}
