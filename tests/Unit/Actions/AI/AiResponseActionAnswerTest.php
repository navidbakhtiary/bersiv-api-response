<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Ai;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\AI\AiResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AiResponseActionAnswerTest extends TestCase
{
	public function testAnswerReturnsFailureContractWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer();

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(__('bersiv-api-response::messages.failures.no_ai_answer'), $response_data['message']);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testAnswerReturnsFailureContractWithGivenErrorsWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$errors = [
			'answer' => ['No matching AI answer was found.'],
		];

		$response = $action->answer(null, $errors);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(__('bersiv-api-response::messages.failures.no_ai_answer'), $response_data['message']);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testAnswerReturnsFailureContractWithJsonResourceErrorsWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$errors = [
			'answer' => ['No matching AI answer was found.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->answer(null, $resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(__('bersiv-api-response::messages.failures.no_ai_answer'), $response_data['message']);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testAnswerReturnsSuccessContractWithArrayData(): void
	{
		$action = new AiResponseAction();

		$data = [
			'answer' => 'This is the generated AI answer.',
			'source' => 'rag',
		];

		$response = $action->answer($data);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(__('bersiv-api-response::messages.successful.ai_answer_generated'), $response_data['message']);
		$this->assertSame($data, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAnswerReturnsSuccessContractWithJsonResourceData(): void
	{
		$action = new AiResponseAction();

		$data = [
			'answer' => 'This is the generated AI answer.',
			'source' => 'rag',
		];

		$resource = JsonResource::make($data);

		$response = $action->answer($resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(__('bersiv-api-response::messages.successful.ai_answer_generated'), $response_data['message']);
		$this->assertSame($data, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
