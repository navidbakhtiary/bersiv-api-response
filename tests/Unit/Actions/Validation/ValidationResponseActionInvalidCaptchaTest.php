<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\ForbiddenResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValidationResponseActionInvalidCaptchaTest extends TestCase
{
	public function testInvalidCaptchaMatchesForbiddenResponseBuilder(): void
	{
		$action = new ValidationResponseAction();

		$actual_response = $action->invalidCaptcha();
		$expected_response = ForbiddenResponse::invalidCaptcha();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testInvalidCaptchaReturnsErrorsKey(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidCaptcha();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidCaptchaReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidCaptcha();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testInvalidCaptchaReturnsGivenArrayErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'captcha' => ['Captcha validation failed.'],
		];

		$response = $action->invalidCaptcha($errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidCaptchaReturnsGivenJsonResourceErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'captcha' => ['Captcha validation failed.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->invalidCaptcha($resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidCaptchaReturnsForbiddenStatusCode(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidCaptcha();

		$this->assertSame(JsonResponse::HTTP_FORBIDDEN, $response->getStatusCode());
	}

	public function testInvalidCaptchaReturnsFailureResponseShape(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidCaptcha();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testInvalidCaptchaReturnsFailureStatusFlag(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidCaptcha();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}
}
