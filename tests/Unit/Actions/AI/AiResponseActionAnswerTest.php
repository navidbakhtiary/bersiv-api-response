<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Ai;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\AI\AiResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\NotFoundResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AiResponseActionAnswerTest extends TestCase
{
	public function testAnswerMatchesOkResponseBuilderWhenDataExists(): void
	{
		$action = new AiResponseAction();

		$data = [
			'answer' => 'This is the generated AI answer.',
		];

		$actual_response = $action->answer($data);
		$expected_response = (
			new OkResponse(
				__('bersiv-api-response::messages.successful.ai_answer_generated'),
				$data
			)
		)->send();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testAnswerMatchesNotFoundResponseBuilderWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$actual_response = $action->answer();
		$expected_response = NotFoundResponse::noAiAnswer();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testAnswerReturnsDataKeyWhenDataExists(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer([
			'answer' => 'This is the generated AI answer.',
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAnswerReturnsErrorsKeyWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testAnswerReturnsSuccessResponseShapeWhenDataExists(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer([
			'answer' => 'This is the generated AI answer.',
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testAnswerReturnsFailureResponseShapeWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testAnswerReturnsGivenArrayDataWhenDataExists(): void
	{
		$action = new AiResponseAction();

		$data = [
			'answer' => 'This is the generated AI answer.',
			'source' => 'rag',
		];

		$response = $action->answer($data);

		$response_data = $response->getData(true);

		$this->assertSame($data, $response_data['data']);
	}

	public function testAnswerReturnsGivenJsonResourceDataWhenDataExists(): void
	{
		$action = new AiResponseAction();

		$data = [
			'answer' => 'This is the generated AI answer.',
			'source' => 'rag',
		];

		$resource = JsonResource::make($data);

		$response = $action->answer($resource);

		$response_data = $response->getData(true);

		$this->assertSame($data, $response_data['data']);
	}

	public function testAnswerReturnsGivenArrayErrorsWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$errors = [
			'answer' => ['No matching AI answer was found.'],
		];

		$response = $action->answer(null, $errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testAnswerReturnsGivenJsonResourceErrorsWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$errors = [
			'answer' => ['No matching AI answer was found.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->answer(null, $resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testAnswerReturnsEmptyErrorsArrayWhenDataIsEmptyByDefault(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testAnswerReturnsSuccessStatusFlagWhenDataExists(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer([
			'answer' => 'This is the generated AI answer.',
		]);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}

	public function testAnswerReturnsFailureStatusFlagWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testAnswerReturnsOkStatusCodeWhenDataExists(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer([
			'answer' => 'This is the generated AI answer.',
		]);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testAnswerReturnsNotFoundStatusCodeWhenDataIsEmpty(): void
	{
		$action = new AiResponseAction();

		$response = $action->answer();

		$this->assertSame(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
	}
}
