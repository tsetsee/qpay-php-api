<?php

namespace Qpay\Api\Enum;

enum ObjectType: string
{
    case MERCHANT = 'MERCHANT';
    case INVOICE = 'INVOICE';
    case QR = 'QR';
    case ITEM = 'ITEM';
}
