<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\Aggregate\Photo;
use App\Infrastructure\Laravel\Models\Photo as ModelsPhoto;

interface PhotoRepositoryInterface
{
    public function create(Photo $photo): ModelsPhoto;

}