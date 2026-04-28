<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\System;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\System\SystemResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class SystemResponseActionServerErrorTest extends TestCase
{
	public function testServerErrorReturnsDefaultFailureContract(): void
	{
		$action = new SystemResponseAction();

		$response = $action->serverError();

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.server_error'),
			$response_data['message']
		);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testServerErrorReturnsGivenArrayErrors(): void
	{
		$action = new SystemResponseAction();

		$errors = [
			'exception' => ['Unexpected server error.'],
		];

		$response = $action->serverError($errors);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.server_error'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
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

		$this->assertSame(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.server_error'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}
}
