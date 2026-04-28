<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValidationResponseActionInvalidCaptchaTest extends TestCase
{
	public function testInvalidCaptchaReturnsDefaultFailureContract(): void
	{
		$action = new ValidationResponseAction();

		$response = $action->invalidCaptcha();

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_FORBIDDEN, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_captcha'),
			$response_data['message']
		);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidCaptchaReturnsGivenArrayErrors(): void
	{
		$action = new ValidationResponseAction();

		$errors = [
			'captcha' => ['Captcha validation failed.'],
		];

		$response = $action->invalidCaptcha($errors);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_FORBIDDEN, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_captcha'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
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

		$this->assertSame(JsonResponse::HTTP_FORBIDDEN, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.invalid_captcha'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}
}
