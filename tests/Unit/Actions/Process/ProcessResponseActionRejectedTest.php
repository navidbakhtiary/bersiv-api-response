<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Process\ProcessResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ProcessResponseActionRejectedTest extends TestCase
{
    public function test_rejected_returns_default_failure_contract(): void
    {
        $action = new ProcessResponseAction;

        $response = $action->rejected('Data import');

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.process_rejected', ['name' => 'Data import']),
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
        $action = new ProcessResponseAction;

        $errors = [
            'process' => ['The requested process cannot be started.'],
        ];

        $response = $action->rejected('Data import', $errors);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.process_rejected', ['name' => 'Data import']),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    public function test_rejected_returns_given_json_resource_errors(): void
    {
        $action = new ProcessResponseAction;

        $errors = [
            'process' => ['The requested process cannot be started.'],
        ];

        $resource = JsonResource::make($errors);

        $response = $action->rejected('Data import', $resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.failures.process_rejected', ['name' => 'Data import']),
            $response_data['message']
        );
        $this->assertSame($errors, $response_data['errors']);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }
}
