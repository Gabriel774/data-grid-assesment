<?php

namespace App\Enums;

enum MovieGenre: string
{
    case ACTION = 'action';
    case COMEDY = 'comedy';
    case DRAMA = 'drama';
    case HORROR = 'horror';
    case ROMANCE = 'romance';
    case SCIFI = 'scifi';
}