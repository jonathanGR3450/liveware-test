<?php

declare(strict_types=1);

namespace App\Domain\Employees\Aggregate;

use App\Domain\Employees\Contracts\EmployeeInterface;
use App\Domain\Employees\ValueObjects\Attempts;
use App\Domain\Employees\ValueObjects\Department;
use App\Domain\Employees\ValueObjects\Email;
use App\Domain\Employees\ValueObjects\FirstName;
use App\Domain\Employees\ValueObjects\HasAccess;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Employees\ValueObjects\LastName;
use App\Domain\Employees\ValueObjects\Password;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\UserInterface\Presenter\Employees\EmployeePresenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;

class Employee implements EmployeeInterface
{
    private function __construct(
        private Id $id,
        private FirstName $first_name,
        private LastName $last_name,
        private Department $department,
        private HasAccess $has_access,
        private Email $email,
        private Password $password,
        private DateTimeValueObject $created_at,
        private ?DateTimeValueObject $updated_at,
        private ?Attempts $attempts,
    ) {
    }

    public static function create(
        Id $id,
        FirstName $first_name,
        LastName $last_name,
        Department $department,
        HasAccess $has_access,
        Email $email,
        Password $password,
        DateTimeValueObject $created_at,
        ?DateTimeValueObject $updated_at = null,
        ?Attempts $attempts = null
    ): self {
        return new self(
            $id,
            $first_name,
            $last_name,
            $department,
            $has_access,
            $email,
            $password,
            $created_at,
            $updated_at,
            $attempts
        );
    }

    public static function employeesFromCSV(string $path): array
    {
        $csv = array_map('str_getcsv', file($path));
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
            $a['password'] = Hash::make($a['password']);
        });
        array_shift($csv); # remove column header
        return $csv;
    }

    public static function attempt(string $email, string $password): string|null
    {
        $credentials = compact('email', 'password');
        if (Auth::guard('employee')->attempt($credentials)) {
            $accessToken = Auth::guard('employee')->user()->createToken('authToken')->accessToken;
            return $accessToken;
        }
        return null;
    }

    public static function pdfEmployees(array $employees): \Barryvdh\DomPDF\PDF
    {
        $pdf = PDF::loadView('pdf.downloadReport', compact('employees'));
        return $pdf;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function firstName(): FirstName
    {
        return $this->first_name;
    }

    public function lastName(): LastName
    {
        return $this->last_name;
    }

    public function department(): Department
    {
        return $this->department;
    }

    public function hasAccess(): HasAccess
    {
        return $this->has_access;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function updateDepartment(string $department): void
    {
        $this->department = Department::fromString($department);
    }

    public function updateHasAccess(bool $has_access): void
    {
        $this->has_access = HasAccess::fromBoolean($has_access);
    }

    public function updateEmail(string $email): void
    {
        $this->email = Email::fromString($email);
    }

    public function updatePassword(string $password): void
    {
        $this->password = Password::fromString($password);
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->created_at;
    }

    public function updatedAt(): ?DateTimeValueObject
    {
        return $this->updated_at;
    }

    public function attempts(): ?Attempts
    {
        return $this->attempts;
    }

    public function updateFirstName(string $first_name): void
    {
        $this->first_name = FirstName::fromString($first_name);
    }

    public function updateLastName(string $last_name): void
    {
        $this->last_name = LastName::fromString($last_name);
    }

    public function employeeLoginAttempt(): void
    {
        // register attempt login employee
    }

    public function present(): EmployeePresenter
    {
        return new EmployeePresenter($this);
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'first_name' => $this->firstName()->value(),
            'last_name' => $this->lastName()->value(),
            'department' => $this->department()->value(),
            'has_access' => $this->hasAccess()->value(),
            'email' => $this->email()->value(),
            'created_at' => $this->createdAt()->value(),
            'updated_at' => $this->updatedAt()?->value(),
            'attemps' => $this->attempts()?->value(),
        ];
    }
}
