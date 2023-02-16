<?php

namespace Tsetsee\Qpay\Api\DTO;

use Carbon\Carbon;
use Symfony\Component\Serializer\Annotation\Context;
use Tsetsee\DTO\Attributes\MapFrom;
use Tsetsee\DTO\DTO\TseDTO;
use Tsetsee\DTO\Serializer\Normalizer\CarbonNormalizer;
use Tsetsee\Qpay\Api\Enum\AuthTokenType;

class AuthTokenDTO extends TseDTO
{
    /**
     * Токены төрөл.
     */
    #[MapFrom('token_type')]
    public AuthTokenType $tokenType;

    /**
     * refresh токены дуусах хугацаа /timestamp/.
     */
    #[MapFrom('refresh_expires_in')]
    #[Context(
        denormalizationContext: [
            CarbonNormalizer::FORMAT_KEY => 'X',
        ],
    )]
    public Carbon $refreshExpiresIn;

    /**
     * access токен сунгахдаа ашиглана.
     */
    #[MapFrom('refresh_token')]
    public string $refreshToken;

    /**
     * Хандах эрх буюу token.
     */
    #[MapFrom('access_token')]
    public string $accessToken;

    /**
     * Access токены дуусах хугацаа /timestamp/.
     */
    #[MapFrom('expires_in')]
    #[Context(
        denormalizationContext: [
            CarbonNormalizer::FORMAT_KEY => 'X',
        ],
    )]
    public Carbon $expiresIn;

    /**
     * Хамрах хүрээ.
     */
    public string $scope;

    /**
     * Өмнөх токеноо хүчингүй болгож болзошгүйг анхааруулна.
     */
    #[MapFrom('not-before-policy')]
    public string $notBeforePolicy;

    /**
     * Токен авсан төлөв.
     */
    #[MapFrom('session_state')]
    public string $sessionState;
}
