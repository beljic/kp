# Projekat za registraciju korisnika

Ovaj projekat implementira sistem za registraciju korisnika koristeći PHP i MySQL. Projekat je organizovan prema SOLID principima i koristi PHP 8.3.

## SOLID Principi

### Single Responsibility Principle (SRP)
Svaka klasa u projektu ima jedinstvenu odgovornost. Na primer, klasa `EmailValidator` je odgovorna samo za validaciju email adresa.

```php
namespace src\app\Validators;

class EmailValidator implements ValidatorInterface {
    private string $errorMessage = 'Invalid email address';

    public function validate($value, $data = []): bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getErrorMessage(): string {
        return $this->errorMessage;
    }
}
```

Ostali validatori koji se koriste u projektu:
- `PasswordValidator` – Validacija jačine lozinke
- `RequiredValidator` – Provera da li je polje popunjeno
- `EmailExistsValidator` – Provera da li email već postoji u bazi
- `PasswordMatchValidator` – Provera podudaranja lozinki
- `MaxMindValidator` – Provera geolokacije korisnika

### Open/Closed Principle (OCP)
Klase su otvorene za proširenje, ali zatvorene za modifikaciju. Na primer, klasa `UserService` može biti proširena novim validatorima bez modifikacije postojećeg koda.

```php
namespace src\app\Services;

class UserService {
    private UserRepository $userRepository;
    private array $validators;

    public function __construct(UserRepository $userRepository, array $validators) {
        $this->userRepository = $userRepository;
        $this->validators = $validators;
    }
}
```

### Liskov Substitution Principle (LSP)
Podtipovi moraju biti zamenljivi za svoje bazne tipove. Na primer, sve klase validatora implementiraju `ValidatorInterface`, osiguravajući da mogu biti korišćene naizmenično.

```php
namespace src\app\Validators;

interface ValidatorInterface {
    public function validate($value, $data = []): bool;
    public function getErrorMessage(): string;
}
```

### Interface Segregation Principle (ISP)
Klijenti ne bi trebalo da budu primorani da zavise od interfejsa koje ne koriste. Na primer, `ValidatorInterface` je mali i specifičan, osiguravajući da implementirajuće klase moraju da obezbede samo relevantne metode.

### Dependency Inversion Principle (DIP)
Moduli visokog nivoa ne bi trebalo da zavise od modula niskog nivoa, već od apstrakcija. Na primer, `UserService` zavisi od interfejsa `UserRepository` umesto od konkretne implementacije.

```php
namespace src\app\Services;

use src\app\Resource\Database\UserRepository;

class UserService {
    private UserRepository $userRepository;
    private array $validators;

    public function __construct(UserRepository $userRepository, array $validators) {
        $this->userRepository = $userRepository;
        $this->validators = $validators;
    }
}
```

## Ostale komponente projekta

### Servisi
- `UserService` – Rukuje registracijom korisnika
- `MailService` – Slanje email obaveštenja korisnicima

### Pomoćne klase
- `Logger` – Omogućava logovanje grešaka i informacija
- `JsonResponse` – Omogućava vraćanje JSON odgovora API-ju

## Instalacija

1. Klonirajte repozitorijum:
   ```sh
   git clone https://github.com/beljic/kp.git
   cd kp
   ```

2. Instalirajte zavisnosti:
   ```sh
   composer install
   ```

3. Podesite `.env` fajl:
   ```sh
   cp .env.example .env
   ```
   Zatim uredite `.env` prema vašim potrebama (baza podataka, email, itd.).

4. Pokrenite Docker (opciono):
   ```sh
   docker-compose up -d
   ```

5. Pokrenite aplikaciju:
   ```sh
   php -S localhost:8000 -t public
   ```

6. Pokrenite testove:
   ```sh
   vendor/bin/phpunit
   ```

## API Odgovori

Aplikacija koristi JSON API odgovore putem `JsonResponse` klase. Primer odgovora:

```json
{
  "status": "success",
  "message": "Registracija uspešna!"
}
```

## Licenca

Ovaj projekat je licenciran pod MIT licencom. Pogledajte `LICENSE.md` fajl za više informacija.

