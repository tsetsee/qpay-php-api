<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Address extends DataTransferObject
{
    public function __construct(
        /**
         * Хот
         *
         * Example: Ulaanbaatar
         */
        public ?string $city,
        /**
         * Дүүрэг.
         *
         * Example: Sukhbaatar
         */
        public ?string $district,
        /**
         * Гудамж.
         *
         * Example: Olimp street
         */
        public ?string $street,
        /**
         * Барилга.
         *
         * Example: Ayud
         */
        public ?string $building,
        /**
         * Хаяг.
         *
         * Example: 1504
         */
        public ?string $address,
        /**
         * Зип код.
         *
         * Example: 14240
         */
        public ?string $zipcode,
        /**
         * Уртраг.
         *
         * Example: 47.91324
         */
        public ?string $longitude,
        /**
         * Өргөрөг.
         *
         * Example: 106.902134234
         */
        public ?string $latitude,
    ) {
    }
}
