<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Process\ProcessResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ProcessResponseActionFinishedTest extends TestCase
{
    public function test_finished_returns_default_success_contract(): void
    {
        $action = new ProcessResponseAction;

        $response = $action->finished('Data import');

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.process_finished', ['name' => 'Data import']),
            $response_data['message']
        );
        $this->assertSame([], $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_finished_returns_given_array_data(): void
    {
        $action = new ProcessResponseAction;

        $data = [
            'imported_rows' => 250,
            'skipped_rows' => 3,
        ];

        $response = $action->finished('Data import', $data);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.process_finished', ['name' => 'Data import']),
            $response_data['message']
        );
        $this->assertSame($data, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }

    public function test_finished_returns_given_json_resource_data(): void
    {
        $action = new ProcessResponseAction;

        $data = [
            'imported_rows' => 250,
            'skipped_rows' => 3,
        ];

        $resource = JsonResource::make($data);

        $response = $action->finished('Data import', $resource);

        $response_data = $response->getData(true);

        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertSame(
            __('bersiv-api-response::messages.successful.process_finished', ['name' => 'Data import']),
            $response_data['message']
        );
        $this->assertSame($data, $response_data['data']);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
