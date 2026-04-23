<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\DetailResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\NotFoundResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class DetailResponseActionTest extends TestCase
{
	public function testHandleReturnsDataKeyWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', [
			'email' => 'navid@example.com',
			'id' => 1,
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsGivenArrayDataWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$payload = [
			'email' => 'navid@example.com',
			'id' => 1,
			'name' => 'Navid',
		];

		$response = $action->handle('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testHandleReturnsGivenJsonResourceDataWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$payload = [
			'email' => 'navid@example.com',
			'id' => 1,
			'name' => 'Navid',
		];

		$resource = JsonResource::make($payload);

		$response = $action->handle('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testHandleReturnsFoundMessageWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', [
			'id' => 1,
		]);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.model_found', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testHandleReturnsOkStatusCodeWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', [
			'id' => 1,
		]);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testHandleReturnsSuccessResponseShapeWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', [
			'id' => 1,
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testHandleReturnsSuccessStatusFlagWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', [
			'id' => 1,
		]);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}

	public function testHandleMatchesNotFoundResponseWhenModelResourceIsNull(): void
	{
		$action = new DetailResponseAction();

		$actual_response = $action->handle('user', null);
		$expected_response = NotFoundResponse::resourceNotFound('user');

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testHandleReturnsErrorsKeyWhenModelResourceIsNull(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', null);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testHandleReturnsNotFoundStatusCodeWhenModelResourceIsNull(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', null);

		$this->assertSame(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
	}

	public function testHandleReturnsFailureResponseShapeWhenModelResourceIsNull(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', null);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testHandleReturnsFailureStatusFlagWhenModelResourceIsNull(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', null);

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testHandleMatchesNotFoundResponseWhenModelResourceIsOmitted(): void
	{
		$action = new DetailResponseAction();

		$actual_response = $action->handle('user');
		$expected_response = NotFoundResponse::resourceNotFound('user');

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testHandleReturnsEmptyErrorsArrayWhenModelResourceIsNull(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user', null);

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}
}
