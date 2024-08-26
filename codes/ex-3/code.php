<?php

trait infoTrait
{
    public ?string $firstName = null;
    public ?string $lastName = null;

    public static function firstName(string $firstName): static
    {
        $instance = new self();
        if (strlen($firstName) >= 3 && strlen($firstName) <= 15 && preg_match('/\d/', $firstName) === 0)
            $instance->firstName = $firstName;
        return $instance;
    }

    public function lastName(string $lastName): static
    {
        if (strlen($lastName) >= 3 && strlen($lastName) <= 15 && preg_match('/\d/', $lastName) === 0)
            $this->lastName = $lastName;
        return $this;
    }
}

class Father
{
    use infoTrait;

    public ?int $age = null;


    public function age(int $age): static
    {
        if ($age >= 18 && $age <= 130)
            $this->age = $age;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'age' => $this->age
        ];
    }
}

class Person
{
    use infoTrait;

    public ?int $age = null;

    public ?Father $father;

    public function age(int $age): static
    {
        if ($age >= 1 && $age <= 130)
            $this->age = $age;
        return $this;
    }

    public function setFather(Father $father): static
    {
        if (
            $this->age > 0 &&
            $father->age >= 18 &&
            $father->age <= 130 &&
            ($father->age - $this->age >= 18) &&
            $father->lastName === $this->lastName
        ) {
            $this->father = $father;
        }

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'age' => $this->age
        ];
        if (isset($this->father)) $data['father'] = $this->father->toArray();

        return $data;
    }

}

$father = Father::firstName('Esaaro')->lastName('Ozaaraa')->age(5);

$dumped = Person::firstName("Soobaasaa")->lastName("Ozaaraa")->age(0)
    ->setFather($father)->toArray();
echo '<pre>';
var_dump($dumped);
echo '<pre>';
exit();
