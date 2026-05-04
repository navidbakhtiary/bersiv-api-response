<?php

namespace NBDev\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Actions\Data\RangesResponseAction;
use NBDev\BersivApiResponse\Tests\TestCase;

class RangesResponseActionAttributeRangesTest extends TestCase
{
    public function test_attribute_ranges_returns_empty_success_contract_when_ranges_are_empty(): void
    {
        $action = new RangesResponseAction;

        $response = $action->attributeRanges('user', []);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_attributes_ranges', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_attribute_ranges_returns_empty_success_contract_when_ranges_are_omitted(): void
    {
        $action = new RangesResponseAction;

        $response = $action->attributeRanges('user');

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.empty_attributes_ranges', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_attribute_ranges_returns_success_contract_when_ranges_exist(): void
    {
        $action = new RangesResponseAction;

        $payload = [
            'age' => [
                'max' => 65,
                'min' => 18,
            ],
            'credit' => [
                'max' => 1000,
                'min' => 200,
            ],
        ];

        $response = $action->attributeRanges('user', $payload);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.attributes_ranges_retrieved', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_attribute_ranges_returns_success_contract_with_json_resource_data(): void
    {
        $action = new RangesResponseAction;

        $payload = [
            'age' => [
                'max' => 65,
                'min' => 18,
            ],
            'credit' => [
                'max' => 1000,
                'min' => 200,
            ],
        ];

        $resource = JsonResource::make($payload);

        $response = $action->attributeRanges('user', $resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.attributes_ranges_retrieved', ['model' => 'user']),
            $response_data['message']
        );
        $this->assertSame($payload, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
