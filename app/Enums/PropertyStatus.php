<?php

namespace App\Enums;

enum PropertyStatus: int
{
    case DRAFT = 0;
    case PUBLISHED = 1;
    case ARCHIVED = 2;
}
