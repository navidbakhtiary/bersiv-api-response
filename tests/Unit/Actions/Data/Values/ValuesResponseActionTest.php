<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\Data\ValuesResponseAction;
use NBDev\BersivApiResponse\Tests\TestCase;

class ValuesResponseActionTest extends TestCase
{
    public function test_handle_returns_empty_success_contract_when_values_are_empty(): void
    {
        $action = new ValuesResponseAction;

        $response = $action->handle('user', 'status', []);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_values_list', [
                'model' => 'user',
                'attribute' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_handle_returns_empty_success_contract_when_values_are_omitted(): void
    {
        $action = new ValuesResponseAction;

        $response = $action->handle('user', 'status');

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_values_list', [
                'model' => 'user',
                'attribute' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_handle_returns_success_contract_when_values_exist(): void
    {
        $action = new ValuesResponseAction;

        $values = ['active', 'inactive'];

        $response = $action->handle('user', 'status', $values);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.values_list_retrieved', [
                'model' => 'user',
                'attribute' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame($values, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_handle_returns_success_contract_with_json_resource_data(): void
    {
        $action = new ValuesResponseAction;

        $values = ['active', 'inactive'];

        $resource = JsonResource::make($values);

        $response = $action->handle('user', 'status', $resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.values_list_retrieved', [
                'model' => 'user',
                'attribute' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame($values, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
