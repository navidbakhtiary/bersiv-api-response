<?php

namespace NBDev\BersivApiResponse\Managers;

use NBDev\BersivApiResponse\Actions\AI\AiResponseAction;
use NBDev\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NBDev\BersivApiResponse\Actions\Data\DetailResponseAction;
use NBDev\BersivApiResponse\Actions\Data\ListResponseAction;
use NBDev\BersivApiResponse\Actions\Data\RangesResponseAction;
use NBDev\BersivApiResponse\Actions\Data\ValuesResponseAction;
use NBDev\BersivApiResponse\Actions\ExternalApi\ExternalApiResponseAction;
use NBDev\BersivApiResponse\Actions\Process\ProcessResponseAction;
use NBDev\BersivApiResponse\Actions\RateLimit\RateLimitResponseAction;
use NBDev\BersivApiResponse\Actions\System\SystemResponseAction;
use NBDev\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesAiResponses;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesAuthenticationResponses;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesDataResponses;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesExternalApiResponses;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesProcessResponses;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesRateLimitResponses;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesSystemResponses;
use NBDev\BersivApiResponse\Managers\Concerns\HandlesValidationResponses;

/**
 * Central manager for Bersiv response actions.
 *
 * This manager acts as the main entry point behind the BersivApiResponse facade.
 * It delegates response generation to specialized action classes grouped by concern,
 * such as AI responses, data responses, authentication responses, process responses,
 * validation responses, and external API responses.
 */
class BersivApiResponseManager
{
    use HandlesAiResponses;
    use HandlesAuthenticationResponses;
    use HandlesDataResponses;
    use HandlesExternalApiResponses;
    use HandlesProcessResponses;
    use HandlesRateLimitResponses;
    use HandlesSystemResponses;
    use HandlesValidationResponses;

    /**
     * Create a new manager instance.
     *
     * @param  AiResponseAction  $ai_response_action  Handles AI-related responses.
     * @param  AuthenticationResponseAction  $authentication_response_action  Handles authentication-related responses.
     * @param  DetailResponseAction  $detail_response_action  Handles single-resource detail responses.
     * @param  ExternalApiResponseAction  $external_api_response_action  Handles external API failure responses.
     * @param  ListResponseAction  $list_response_action  Handles list and collection responses.
     * @param  ProcessResponseAction  $process_response_action  Handles background process responses.
     * @param  RangesResponseAction  $ranges_response_action  Handles attribute/date range responses.
     * @param  RateLimitResponseAction  $rate_limit_response_action  Handles too many requests responses.
     * @param  SystemResponseAction  $system_response_action  Handles system-level responses.
     * @param  ValidationResponseAction  $validation_response_action  Handles validation-related failure responses.
     * @param  ValuesResponseAction  $values_response_action  Handles attribute values responses.
     */
    public function __construct(
        protected AiResponseAction $ai_response_action,
        protected AuthenticationResponseAction $authentication_response_action,
        protected DetailResponseAction $detail_response_action,
        protected ExternalApiResponseAction $external_api_response_action,
        protected ListResponseAction $list_response_action,
        protected ProcessResponseAction $process_response_action,
        protected RangesResponseAction $ranges_response_action,
        protected RateLimitResponseAction $rate_limit_response_action,
        protected SystemResponseAction $system_response_action,
        protected ValidationResponseAction $validation_response_action,
        protected ValuesResponseAction $values_response_action,
    ) {}
}
