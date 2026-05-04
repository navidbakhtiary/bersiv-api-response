<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\System;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\System\SystemResponseAction;
use NBDev\BersivApiResponse\Tests\TestCase;

class SystemResponseActionServerErrorTest extends TestCase
{
    public function test_server_error_returns_default_failure_contract(): void
    {
        $action = new SystemResponseAction;

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

    public function test_server_error_returns_given_array_errors(): void
    {
        $action = new SystemResponseAction;

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

    public function test_server_error_returns_given_json_resource_errors(): void
    {
        $action = new SystemResponseAction;

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
