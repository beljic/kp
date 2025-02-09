# Projekat za registraciju korisnika

Ovaj projekat implementira sistem za registraciju korisnika koristeći PHP i MySQL. Projekat je organizovan prema SOLID principima i koristi PHP 8.3.

## Struktura projekta

- `src/App/Validators/`
    - `PasswordValidator.php`
    - `EmailValidator.php`
    - ...
- `src/App/Services/`
    - `UserService.php`
- `src/App/Database/`
    - `Database.php`
- `src/Resource/Database/`
    - `UserRepository.php`
- `src/App/Responses/`
    - `JsonResponse.php`
- `public/`
    - `index.php`
    
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
### Open/Closed Principle (OCP)
Klase su otvorene za proširenje, ali zatvorene za modifikaciju. Na primer, klasa UserService može biti proširena novim validatorima bez modifikacije postojećeg koda.
```php
namespace src\app\Services;

class UserService {
    private UserRepository $userRepository;
    private array $validators;

    public function __construct(UserRepository $userRepository, array $validators) {
        $this->userRepository = $userRepository;
        $this->validators = $validators;
    }

    // Ostale metode...
}
```

### Liskov Substitution Principle (LSP)

Podtipovi moraju biti zamenljivi za svoje bazne tipove. Na primer, sve klase validatora implementiraju ValidatorInterface, osiguravajući da mogu biti korišćene naizmenično.
```php

namespace src\app\Validators;

interface ValidatorInterface {
    public function validate($value, $data = []): bool;
    public function getErrorMessage(): string;
}
```

### Interface Segregation Principle (ISP)

Klijenti ne bi trebalo da budu primorani da zavise od interfejsa koje ne koriste. Na primer, ValidatorInterface je mali i specifičan, osiguravajući da implementirajuće klase moraju da obezbede samo relevantne metode.
```php
namespace src\app\Validators;

interface ValidatorInterface {
    public function validate($value, $data = []): bool;
    public function getErrorMessage(): string;
}
```

### Dependency Inversion Principle (DIP)
Moduli visokog nivoa ne bi trebalo da zavise od modula niskog nivoa, već od apstrakcija. Na primer, UserService zavisi od interfejsa UserRepository umesto od konkretne implementacije.
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

    // Ostale metode...
}
```

## Instalacija

Instalacija
Klonirajte repozitorijum.
Pokrenite composer install da instalirate zavisnosti.
Podesite vaše promenljive okruženja u .env fajlu.
Korišćenje
Pokrenite aplikaciju koristeći sledeću komandu:

Licenca
Ovaj projekat je licenciran pod MIT licencom. Pogledajte LICENSE.md fajl za više informacija.
```

