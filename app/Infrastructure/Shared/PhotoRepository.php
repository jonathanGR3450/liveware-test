<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared;

use App\Domain\Shared\Aggregate\Photo;
use App\Domain\Shared\ValueObjects\Photo\Id;
use App\Domain\Shared\ValueObjects\Photo\Path;
use App\Domain\Shared\PhotoRepositoryInterface;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\Infrastructure\Laravel\Models\Photo as ModelsPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PhotoRepository implements PhotoRepositoryInterface
{
    public function create(Photo $photo): ModelsPhoto
    {
        $photoModel = new ModelsPhoto();

        $photoModel->id = $photo->id()->value();
        $photoModel->path = $photo->path()->value();
        $photoModel->name = $photo->name()->value();
        $photoModel->created_at = DateTimeValueObject::now()->value();
        return $photoModel;
        // $photoModel->save();
    }

    public static function map(ModelsPhoto $model): Photo
    {
        return Photo::create(
            Id::fromPrimitives($model->id),
            Path::fromString($model->first_name),
            DateTimeValueObject::fromPrimitives($model->created_at->__toString()),
            !empty($model->updated_at) ? DateTimeValueObject::fromPrimitives($model->updated_at->__toString()) : null
        );
    }
}
