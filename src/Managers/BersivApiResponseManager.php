<?php

namespace NavidBakhtiary\BersivApiResponse\Managers;

use NavidBakhtiary\BersivApiResponse\Actions\AI\AiResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\DetailResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\RangesResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ValuesResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\ExternalApi\ExternalApiResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Process\ProcessResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\RateLimit\RateLimitResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\System\SystemResponseAction;
use NavidBakhtiary\BersivApiResponse\Actions\Validation\ValidationResponseAction;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesAiResponses;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesAuthenticationResponses;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesDataResponses;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesExternalApiResponses;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesProcessResponses;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesRateLimitResponses;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesSystemResponses;
use NavidBakhtiary\BersivApiResponse\Managers\Concerns\HandlesValidationResponses;

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
