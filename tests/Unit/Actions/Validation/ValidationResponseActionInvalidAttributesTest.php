<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Validation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValidationResponseActionInvalidAttributesTest extends TestCase
{
    public function test_invalid_attributes_returns_default_failure_contract(): void
    {
        $action = new ValidationResponseAction;

        $attributes = ['status', 'type'];
        $attributes_text = Utilities::createStringFromArray($attributes);

        $response = $action->invalidAttributes($attributes);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.invalid_attributes', [
                'attributes' => $attributes_text,
            ]),
            $response_data['message']
        );
        $this->assertSame([], $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_invalid_attributes_returns_given_array_errors(): void
    {
        $action = new ValidationResponseAction;

        $attributes = ['status', 'type'];
        $attributes_text = Utilities::createStringFromArray($attributes);

        $errors = [
            'attributes' => ['One or more attributes are invalid.'],
        ];

        $response = $action->invalidAttributes($attributes, $errors);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.invalid_attributes', [
                'attributes' => $attributes_text,
            ]),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_invalid_attributes_returns_given_json_resource_errors(): void
    {
        $action = new ValidationResponseAction;

        $attributes = ['status', 'type'];
        $attributes_text = Utilities::createStringFromArray($attributes);

        $errors = [
            'attributes' => ['One or more attributes are invalid.'],
        ];

        $resource = JsonResource::make($errors);

        $response = $action->invalidAttributes($attributes, $resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.invalid_attributes', [
                'attributes' => $attributes_text,
            ]),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }
}
