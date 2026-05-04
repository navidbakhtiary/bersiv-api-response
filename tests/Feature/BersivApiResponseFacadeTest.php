<?php

namespace NBDev\BersivApiResponse\Tests\Feature;

use Illuminate\Http\JsonResponse;
use NBDev\BersivApiResponse\Facades\BersivApiResponse;
use NBDev\BersivApiResponse\Providers\BersivApiResponseServiceProvider;
use Orchestra\Testbench\TestCase;

class BersivApiResponseFacadeTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            BersivApiResponseServiceProvider::class,
        ];
    }

    public function test_can_return_ai_response_using_facade(): void
    {
        $response = BersivApiResponse::aiAnswer([
            'answer' => 'Generated answer.',
        ]);
        $this->assertSuccessResponse($response, JsonResponse::HTTP_OK);

        $failure_response = BersivApiResponse::aiAnswer();
        $this->assertFailureResponse($failure_response, JsonResponse::HTTP_NOT_FOUND);
    }

    public function test_can_return_authentication_responses_using_facade(): void
    {
        $login_response = BersivApiResponse::login([
            'token' => 'sample-token',
            'user' => [
                'email' => 'navid@example.com',
                'id' => 1,
            ],
        ]);
        $this->assertSuccessResponse($login_response, JsonResponse::HTTP_OK);

        $logout_response = BersivApiResponse::logout();
        $this->assertSuccessResponse($logout_response, JsonResponse::HTTP_OK);

        $token_valid_response = BersivApiResponse::tokenValid();
        $this->assertSuccessResponse($token_valid_response, JsonResponse::HTTP_OK);

        $invalid_login_credentials_response = BersivApiResponse::invalidLoginCredentials();
        $this->assertFailureResponse($invalid_login_credentials_response, JsonResponse::HTTP_UNAUTHORIZED);

        $invalid_token_response = BersivApiResponse::invalidToken();
        $this->assertFailureResponse($invalid_token_response, JsonResponse::HTTP_UNAUTHORIZED);

        $unauthenticated_response = BersivApiResponse::unauthenticated();
        $this->assertFailureResponse($unauthenticated_response, JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function test_can_return_data_responses_using_facade(): void
    {
        $detail_response = BersivApiResponse::detail('user', [
            'id' => 1,
        ]);
        $this->assertSuccessResponse($detail_response, JsonResponse::HTTP_OK);

        $missing_detail_response = BersivApiResponse::detail('user');
        $this->assertFailureResponse($missing_detail_response, JsonResponse::HTTP_NOT_FOUND);

        $list_response = BersivApiResponse::list('user', [
            [
                'id' => 1,
            ],
        ]);
        $this->assertSuccessResponse($list_response, JsonResponse::HTTP_OK);

        $empty_list_response = BersivApiResponse::list('user');
        $this->assertSuccessResponse($empty_list_response, JsonResponse::HTTP_OK);

        $search_results_response = BersivApiResponse::searchResults('user', [
            [
                'id' => 1,
            ],
        ]);
        $this->assertSuccessResponse($search_results_response, JsonResponse::HTTP_OK);

        $empty_search_results_response = BersivApiResponse::searchResults('user');
        $this->assertSuccessResponse($empty_search_results_response, JsonResponse::HTTP_OK);

        $filtered_list_response = BersivApiResponse::filteredList('user', 'status', [
            [
                'id' => 1,
                'status' => 'active',
            ],
        ]);
        $this->assertSuccessResponse($filtered_list_response, JsonResponse::HTTP_OK);

        $empty_filtered_list_response = BersivApiResponse::filteredList('user', 'status');
        $this->assertSuccessResponse($empty_filtered_list_response, JsonResponse::HTTP_OK);

        $attributes_list_response = BersivApiResponse::attributesList('user', ['name', 'email']);
        $this->assertSuccessResponse($attributes_list_response, JsonResponse::HTTP_OK);

        $empty_attributes_list_response = BersivApiResponse::attributesList('user');
        $this->assertSuccessResponse($empty_attributes_list_response, JsonResponse::HTTP_OK);

        $attribute_ranges_response = BersivApiResponse::attributeRanges('user', [
            'age' => [
                'max' => 65,
                'min' => 18,
            ],
        ]);
        $this->assertSuccessResponse($attribute_ranges_response, JsonResponse::HTTP_OK);

        $empty_attribute_ranges_response = BersivApiResponse::attributeRanges('user');
        $this->assertSuccessResponse($empty_attribute_ranges_response, JsonResponse::HTTP_OK);

        $date_range_response = BersivApiResponse::dateRange('user', [
            'end_date' => '2026-12-31',
            'start_date' => '2026-01-01',
        ]);
        $this->assertSuccessResponse($date_range_response, JsonResponse::HTTP_OK);

        $empty_date_range_response = BersivApiResponse::dateRange('user');
        $this->assertSuccessResponse($empty_date_range_response, JsonResponse::HTTP_OK);

        $values_response = BersivApiResponse::valuesList('user', 'status', ['active', 'inactive']);
        $this->assertSuccessResponse($values_response, JsonResponse::HTTP_OK);

        $empty_values_response = BersivApiResponse::valuesList('user', 'status');
        $this->assertSuccessResponse($empty_values_response, JsonResponse::HTTP_OK);
    }

    public function test_can_return_external_api_responses_using_facade(): void
    {
        $rejected_response = BersivApiResponse::externalApiRejected();
        $this->assertFailureResponse($rejected_response, JsonResponse::HTTP_BAD_GATEWAY);

        $unavailable_response = BersivApiResponse::externalApiUnavailable();
        $this->assertFailureResponse($unavailable_response, JsonResponse::HTTP_SERVICE_UNAVAILABLE);
    }

    public function test_can_return_process_responses_using_facade(): void
    {
        $accepted_response = BersivApiResponse::processAccepted('Data import');
        $this->assertSuccessResponse($accepted_response, JsonResponse::HTTP_ACCEPTED);

        $finished_response = BersivApiResponse::processFinished('Data import');
        $this->assertSuccessResponse($finished_response, JsonResponse::HTTP_OK);

        $rejected_response = BersivApiResponse::processRejected('Data import');
        $this->assertFailureResponse($rejected_response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_can_return_rate_limit_response_using_facade(): void
    {
        $response = BersivApiResponse::tooManyRequests();

        $this->assertFailureResponse($response, JsonResponse::HTTP_TOO_MANY_REQUESTS);
    }

    public function test_can_return_system_response_using_facade(): void
    {
        $response = BersivApiResponse::serverError();

        $this->assertFailureResponse($response, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function test_can_return_validation_responses_using_facade(): void
    {
        $invalid_inputs_response = BersivApiResponse::invalidInputs();
        $this->assertFailureResponse($invalid_inputs_response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        $invalid_attributes_response = BersivApiResponse::invalidAttributes(['status', 'type']);
        $this->assertFailureResponse($invalid_attributes_response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        $invalid_captcha_response = BersivApiResponse::invalidCaptcha();
        $this->assertFailureResponse($invalid_captcha_response, JsonResponse::HTTP_FORBIDDEN);
    }

    private function assertFailureResponse(JsonResponse $response, int $status_code): void
    {
        $response_data = $response->getData(true);

        $this->assertSame($status_code, $response->getStatusCode());
        $this->assertFalse($response_data['success']);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayHasKey('errors', $response_data);
        $this->assertArrayNotHasKey('data', $response_data);
    }

    private function assertSuccessResponse(JsonResponse $response, int $status_code): void
    {
        $response_data = $response->getData(true);

        $this->assertSame($status_code, $response->getStatusCode());
        $this->assertTrue($response_data['success']);
        $this->assertArrayHasKey('message', $response_data);
        $this->assertArrayHasKey('success', $response_data);
        $this->assertArrayHasKey('data', $response_data);
        $this->assertArrayNotHasKey('errors', $response_data);
    }
}
