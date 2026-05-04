<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NBDev\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionUnauthenticatedTest extends TestCase
{
    public function test_unauthenticated_returns_default_failure_contract(): void
    {
        $action = new AuthenticationResponseAction;

        $response = $action->unauthenticated();

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.failures.unauthenticated'), $response_data['message']);
        $this->assertSame([], $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_unauthenticated_returns_given_array_errors(): void
    {
        $action = new AuthenticationResponseAction;

        $errors = [
            'token' => ['The provided token is invalid.'],
        ];

        $response = $action->unauthenticated($errors);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.failures.unauthenticated'), $response_data['message']);
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_unauthenticated_returns_given_json_resource_errors(): void
    {
        $action = new AuthenticationResponseAction;

        $errors = [
            'token' => ['The provided token is invalid.'],
        ];

        $resource = JsonResource::make($errors);

        $response = $action->unauthenticated($resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.failures.unauthenticated'), $response_data['message']);
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }
}
