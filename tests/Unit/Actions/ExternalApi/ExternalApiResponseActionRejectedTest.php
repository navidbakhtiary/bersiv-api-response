<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\ExternalApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\ExternalApi\ExternalApiResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ExternalApiResponseActionRejectedTest extends TestCase
{
    public function test_rejected_returns_default_failure_contract(): void
    {
        $action = new ExternalApiResponseAction;

        $response = $action->rejected();

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_BAD_GATEWAY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.external_api_rejected'),
            $response_data['message']
        );
        $this->assertSame([], $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_rejected_returns_given_array_errors(): void
    {
        $action = new ExternalApiResponseAction;

        $errors = [
            'upstream' => ['Validation failed in external API.'],
        ];

        $response = $action->rejected($errors);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_BAD_GATEWAY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.external_api_rejected'),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_rejected_returns_given_json_resource_errors(): void
    {
        $action = new ExternalApiResponseAction;

        $errors = [
            'upstream' => ['Validation failed in external API.'],
        ];

        $resource = JsonResource::make($errors);

        $response = $action->rejected($resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_BAD_GATEWAY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.external_api_rejected'),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }
}
