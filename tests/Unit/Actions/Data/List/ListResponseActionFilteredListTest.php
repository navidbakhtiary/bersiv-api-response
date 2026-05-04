<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\Data\ListResponseAction;
use NBDev\BersivApiResponse\Helpers\Utilities;
use NBDev\BersivApiResponse\Tests\TestCase;

class ListResponseActionFilteredListTest extends TestCase
{
    public function test_filtered_list_returns_empty_success_contract_when_data_resource_is_omitted(): void
    {
        $action = new ListResponseAction;

        $response = $action->filteredList('user', 'status');

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_filtered_models_list', [
                'model' => 'user',
                'attributes' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_filtered_list_returns_empty_success_contract_when_collection_is_empty_and_attribute_is_string(): void
    {
        $action = new ListResponseAction;

        $response = $action->filteredList('user', 'status', []);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_filtered_models_list', [
                'model' => 'user',
                'attributes' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_filtered_list_returns_success_contract_when_collection_has_items_and_attribute_is_string(): void
    {
        $action = new ListResponseAction;

        $payload = [
            [
                'id' => 1,
                'status' => 'active',
            ],
        ];

        $response = $action->filteredList('user', 'status', $payload);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
                'model' => 'user',
                'attributes' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_filtered_list_returns_success_contract_when_collection_has_items_and_attributes_are_array(): void
    {
        $action = new ListResponseAction;

        $attributes = ['status', 'type'];
        $attributes_text = Utilities::createStringFromArray($attributes);

        $payload = [
            [
                'id' => 1,
                'status' => 'active',
                'type' => 'admin',
            ],
        ];

        $response = $action->filteredList('user', $attributes, $payload);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
                'model' => 'user',
                'attributes' => $attributes_text,
            ]),
            $response_data['message']
        );
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_filtered_list_returns_success_contract_with_json_resource_data(): void
    {
        $action = new ListResponseAction;

        $payload = [
            [
                'id' => 1,
                'status' => 'active',
            ],
        ];

        $resource = JsonResource::make($payload);

        $response = $action->filteredList('user', 'status', $resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
                'model' => 'user',
                'attributes' => 'status',
            ]),
            $response_data['message']
        );
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_filtered_list_returns_empty_success_contract_when_collection_is_empty_and_attributes_are_array(): void
    {
        $action = new ListResponseAction;

        $attributes = ['status', 'type'];
        $attributes_text = Utilities::createStringFromArray($attributes);

        $response = $action->filteredList('user', $attributes, []);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_filtered_models_list', [
                'model' => 'user',
                'attributes' => $attributes_text,
            ]),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
