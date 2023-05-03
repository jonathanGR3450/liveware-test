<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\ValueObjects\Department;
use App\Domain\Employees\ValueObjects\Email;
use App\Domain\Employees\ValueObjects\FirstName;
use App\Domain\Employees\ValueObjects\HasAccess;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Employees\ValueObjects\LastName;
use App\Domain\Employees\ValueObjects\Password;
use App\Domain\Shared\Aggregate\Photo;
use App\Domain\Shared\ValueObjects\Photo\Id as ValueObjectsId;
use App\Domain\Shared\ValueObjects\Photo\Path;
use App\Domain\Shared\PhotoRepositoryInterface;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\Domain\Shared\ValueObjects\Photo\Name;
use DateTime;

final class CreateEmployeeUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;
    private PhotoRepositoryInterface $photoRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface, PhotoRepositoryInterface $photoRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
        $this->photoRepositoryInterface = $photoRepositoryInterface;
    }

    public function __invoke(
        string $first_name,
        string $last_name,
        string $department,
        bool $has_access,
        string $email,
        string $password,
        ?\Illuminate\Http\UploadedFile $imgFile = null,
    ): Employee {
        $employee = Employee::create(
            Id::random(),
            FirstName::fromString($first_name),
            LastName::fromString($last_name),
            Department::fromString($department),
            HasAccess::fromBoolean($has_access),
            Email::fromString($email),
            Password::fromString($password),
            DateTimeValueObject::now()
        );
        $this->employeeRepositoryInterface->create($employee);

        if ($imgFile) {
            $date = new DateTime();
            $imageName = $date->format('Y-m-d-H-m-s') . '.' . $imgFile->getClientOriginalExtension();
            $photo = Photo::create(
                ValueObjectsId::random(),
                Path::fromString($employee->id()->value() . '/'),
                Name::fromString($imageName),
                DateTimeValueObject::now()
            );
            $photoModel = $this->photoRepositoryInterface->create($photo);
            $this->employeeRepositoryInterface->savePhoto($photoModel, $employee->id());
            $photo->saveFile($imgFile);
        }

        return $employee;
    }
}
