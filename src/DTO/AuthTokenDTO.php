<?php

namespace Qpay\Api\DTO;

use Carbon\Carbon;
use Qpay\Api\Enum\AuthTokenType;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Casters\EnumCaster;
use Tsetsee\DTO\Casters\CarbonCaster;
use Tsetsee\DTO\DTO\TseDTO;

class AuthTokenDTO extends TseDTO
{
    /**
     * Токены төрөл.
     */
    #[MapFrom('token_type')]
    #[CastWith(EnumCaster::class, enumType: AuthTokenType::class)]
    public AuthTokenType $tokenType;

    /**
     * refresh токены дуусах хугацаа /timestamp/.
     */
    #[MapFrom('refresh_expires_in')]
    #[CastWith(CarbonCaster::class, type: 'timestamp')]
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
    #[CastWith(CarbonCaster::class, type: 'timestamp')]
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
