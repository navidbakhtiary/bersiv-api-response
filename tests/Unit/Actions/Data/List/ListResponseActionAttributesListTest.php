<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ListResponseActionAttributesListTest extends TestCase
{
    public function test_attributes_list_returns_success_contract_when_attributes_exist(): void
    {
        $action = new ListResponseAction;

        $attributes = ['name', 'email'];

        $response = $action->attributesList('user', $attributes);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.attributes_list_retrieved', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame($attributes, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_attributes_list_returns_empty_success_contract_when_attributes_are_empty(): void
    {
        $action = new ListResponseAction;

        $response = $action->attributesList('user', []);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_attributes_list', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_attributes_list_returns_empty_success_contract_when_attributes_are_omitted(): void
    {
        $action = new ListResponseAction;

        $response = $action->attributesList('user');

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_attributes_list', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_attributes_list_returns_success_contract_with_json_resource_data(): void
    {
        $action = new ListResponseAction;

        $attributes = ['name', 'email'];

        $resource = JsonResource::make($attributes);

        $response = $action->attributesList('user', $resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.attributes_list_retrieved', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame($attributes, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
