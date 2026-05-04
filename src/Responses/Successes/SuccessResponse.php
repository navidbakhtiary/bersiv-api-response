<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Successes;

use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Responses\ApiResponse;

/**
 * Base class for successful responses.
 *
 * This class ensures that successful responses use the "data" key.
 */
class SuccessResponse extends ApiResponse
{
    /**
     * Create a new success response instance.
     *
     * @param  int  $status_code  The HTTP status code.
     * @param  string  $message  The response message.
     * @param  array|JsonResource  $data  Optional response data payload.
     */
    public function __construct(int $status_code, string $message, array|JsonResource $data = [])
    {
        parent::__construct($status_code, $message, $data);

        $this->is_successful = true;
        $this->setResponseContent('data');
    }
}
