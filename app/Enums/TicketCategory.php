<?php

namespace App\Enums;

enum TicketCategory: string
{
    case general_inquiry = '1';
    case techincal_support = '2';
    case acount_billing = '3';
    case feature_request = '4';
    case feedback = '5';
    case sales_marketing = '6';
    case training_documentation = '7';
    case urgent_high_priority = '8';
}

