<?php

namespace App\Enums;

enum DeliveryType: string
{
    case POST_OFFICE = 'post_office';
    case PARCEL_MACHINE = 'parcel_machine';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
