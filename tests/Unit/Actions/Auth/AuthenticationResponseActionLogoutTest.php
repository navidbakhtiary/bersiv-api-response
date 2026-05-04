<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NBDev\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionLogoutTest extends TestCase
{
    public function test_logout_returns_default_success_contract(): void
    {
        $action = new AuthenticationResponseAction;

        $response = $action->logout();

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.successful.logout'), $response_data['message']);
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_logout_returns_given_array_data(): void
    {
        $action = new AuthenticationResponseAction;

        $payload = [
            'revoked_tokens_count' => 2,
        ];

        $response = $action->logout($payload);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.successful.logout'), $response_data['message']);
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_logout_returns_given_json_resource_data(): void
    {
        $action = new AuthenticationResponseAction;

        $payload = [
            'revoked_tokens_count' => 2,
        ];

        $resource = JsonResource::make($payload);

        $response = $action->logout($resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.successful.logout'), $response_data['message']);
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
