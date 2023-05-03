<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Shared\Aggregate\Photo;
use App\Domain\Shared\PhotoRepositoryInterface;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\Domain\Shared\ValueObjects\Photo\Id as PhotoId;
use App\Domain\Shared\ValueObjects\Photo\Name as PhotoName;
use App\Domain\Shared\ValueObjects\Photo\Path;
use App\Domain\User\Aggregate\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Id;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Password;
use DateTime;

final class CreateUserUseCase
{
    private UserRepositoryInterface $userRepositoryInterface;
    private PhotoRepositoryInterface $photoRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface, PhotoRepositoryInterface $photoRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->photoRepositoryInterface = $photoRepositoryInterface;
    }

    public function __invoke(string $name, string $email, string $password, ?\Illuminate\Http\UploadedFile $imgFile = null): User
    {
        $user = User::create(
            Id::random(),
            Email::fromString($email),
            Name::fromString($name),
            Password::fromString($password),
            DateTimeValueObject::now()
        );
        $this->userRepositoryInterface->create($user);

        if ($imgFile) {
            $date = new DateTime();
            $imageName = $date->format('Y-m-d-H-m-s') . '.' . $imgFile->getClientOriginalExtension();
            $photo = Photo::create(
                PhotoId::random(),
                Path::fromString($user->id()->value() . '/'),
                PhotoName::fromString($imageName),
                DateTimeValueObject::now()
            );
            $photoModel = $this->photoRepositoryInterface->create($photo);
            $this->userRepositoryInterface->savePhoto($photoModel, $user->id());
            $photo->saveFile($imgFile);
        }

        return $user;
    }
}
