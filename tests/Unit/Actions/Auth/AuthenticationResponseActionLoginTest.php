<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionLoginTest extends TestCase
{
    public function test_login_returns_default_success_contract(): void
    {
        $action = new AuthenticationResponseAction;

        $response = $action->login();

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.successful.login'), $response_data['message']);
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_login_returns_given_array_data(): void
    {
        $action = new AuthenticationResponseAction;

        $payload = [
            'token' => 'sample-token',
            'user' => [
                'email' => 'navid@example.com',
                'id' => 1,
            ],
        ];

        $response = $action->login($payload);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.successful.login'), $response_data['message']);
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_login_returns_given_json_resource_data(): void
    {
        $action = new AuthenticationResponseAction;

        $payload = [
            'token' => 'sample-token',
            'user' => [
                'email' => 'navid@example.com',
                'id' => 1,
            ],
        ];

        $resource = JsonResource::make($payload);

        $response = $action->login($resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(__('bersiv-api-response::auths.successful.login'), $response_data['message']);
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
