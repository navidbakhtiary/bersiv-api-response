<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NBDev\BersivApiResponse\Tests\TestCase;

class ValidationResponseActionInvalidCaptchaTest extends TestCase
{
    public function test_invalid_captcha_returns_default_failure_contract(): void
    {
        $action = new ValidationResponseAction;

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

    public function test_invalid_captcha_returns_given_array_errors(): void
    {
        $action = new ValidationResponseAction;

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

    public function test_invalid_captcha_returns_given_json_resource_errors(): void
    {
        $action = new ValidationResponseAction;

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
