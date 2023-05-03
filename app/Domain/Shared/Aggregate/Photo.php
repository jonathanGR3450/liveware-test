<?php

declare(strict_types=1);

namespace App\Domain\Shared\Aggregate;

use App\Domain\Shared\ValueObjects\Photo\Id;
use App\Domain\Shared\ValueObjects\Photo\Path;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\Domain\Shared\ValueObjects\Photo\Name;
use Illuminate\Support\Facades\Storage;

final class Photo
{
    private function __construct(
        private Id $id,
        private Path $path,
        private Name $name,
        private DateTimeValueObject $created_at,
        private ?DateTimeValueObject $updated_at
    ) {
    }

    public static function create(
        Id $id,
        Path $path,
        Name $name,
        DateTimeValueObject $created_at,
        ?DateTimeValueObject $updated_at = null,
    ): self {
        return new self(
            $id,
            $path,
            $name,
            $created_at,
            $updated_at,
        );
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function path(): Path
    {
        return $this->path;
    }

    public function name(): Name
    {
        return $this->name;
    }


    public function createdAt(): DateTimeValueObject
    {
        return $this->created_at;
    }

    public function updatedAt(): ?DateTimeValueObject
    {
        return $this->updated_at;
    }

    public function saveFile(\Illuminate\Http\UploadedFile $file): void
    {
        $path = $this->path()->value();
        $name = $this->name()->value();
        Storage::disk('public')->putFileAs($path, $file, $name);
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'path' => $this->path()->value(),
            'created_at' => $this->createdAt()->value(),
            'updated_at' => $this->updatedAt()?->value(),
        ];
    }
}
