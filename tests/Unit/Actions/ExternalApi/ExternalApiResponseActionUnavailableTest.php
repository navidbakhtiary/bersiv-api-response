<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\ExternalApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\ExternalApi\ExternalApiResponseAction;
use NBDev\BersivApiResponse\Tests\TestCase;

class ExternalApiResponseActionUnavailableTest extends TestCase
{
    public function test_unavailable_returns_default_failure_contract(): void
    {
        $action = new ExternalApiResponseAction;

        $response = $action->unavailable();

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_SERVICE_UNAVAILABLE, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.unavailable_external_api'),
            $response_data['message']
        );
        $this->assertSame([], $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_unavailable_returns_given_array_errors(): void
    {
        $action = new ExternalApiResponseAction;

        $errors = [
            'upstream' => ['Service timeout.'],
        ];

        $response = $action->unavailable($errors);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_SERVICE_UNAVAILABLE, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.unavailable_external_api'),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_unavailable_returns_given_json_resource_errors(): void
    {
        $action = new ExternalApiResponseAction;

        $errors = [
            'upstream' => ['Service timeout.'],
        ];

        $resource = JsonResource::make($errors);

        $response = $action->unavailable($resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_SERVICE_UNAVAILABLE, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.unavailable_external_api'),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }
}
