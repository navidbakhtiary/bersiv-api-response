<?php

namespace NBDev\BersivApiResponse\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Base response class for all Bersiv responses.
 *
 * This class stores the common response data and provides
 * the final JSON response output.
 */
class ApiResponse
{
    /**
     * Indicates whether the response represents a successful operation.
     */
    protected bool $is_successful;

    /**
     * The HTTP status code of the response.
     */
    protected int $status_code;

    /**
     * The response message.
     */
    protected string $message;

    /**
     * The response payload.
     *
     * It may represent either success data or failure errors,
     * depending on the response type.
     */
    protected array|JsonResource $info;

    /**
     * The final response body that will be returned as JSON.
     */
    protected array $response_content = [];

    /**
     * Create a new API response instance.
     *
     * @param  int  $status_code  The HTTP status code.
     * @param  string  $message  The response message.
     * @param  array|JsonResource  $info  Optional response payload.
     */
    public function __construct(int $status_code, string $message, array|JsonResource $info = [])
    {
        $this->status_code = $status_code;
        $this->message = $message;
        $this->info = $info;

        if ($this->info instanceof JsonResource) {
            $this->info = $this->info->resolve(request());
        }
    }

    /**
     * Return the response as a JSON response instance.
     *
     * @return JsonResponse The formatted JSON response.
     */
    public function send(): JsonResponse
    {
        return response()->json($this->response_content, $this->status_code);
    }

    /**
     * Build the final response content structure.
     *
     * @param  string  $key  The payload key, such as "data" or "errors".
     */
    protected function setResponseContent(string $key): void
    {
        $this->response_content = [
            'success' => $this->is_successful,
            'message' => $this->message,
            $key => $this->info,
        ];
    }
}
