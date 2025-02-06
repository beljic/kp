# Projekat za registraciju korisnika

Ovaj projekat implementira sistem za registraciju korisnika koristeći PHP i MySQL. Projekat je organizovan prema SOLID principima i koristi PHP 8.3 funkcionalnosti.

## Struktura projekta

- `src/App/Validators/`
  - `PasswordValidator.php`
  - `EmailValidator.php`
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

## Instalacija

1. Klonirajte repozitorijum:
   ```sh
   git clone https://github.com/vas-repozitorijum/projekat.git# README - PHP 8.3 Sistem za Registraciju sa SOLID Principima

## Pregled
Ovaj projekat refaktoriše osnovni PHP skript za registraciju prateći **SOLID principe** i koristeći **moderni PHP 8.3**. Poboljšava sigurnost, održivost i proširivost odvajanjem odgovornosti u različite klase i koristeći injektovanje zavisnosti.

## Funkcionalnosti
- **Sistem validacije:** Podržava više pravila validacije (format emaila, jačina lozinke, provera postojećeg korisnika, detekcija prevara).
- **Apstrakcija baze podataka:** Fleksibilan servis baze podataka koji omogućava parametarske upite.
- **Simulacija detekcije prevara:** Simulira proveru protiv eksternog sistema za detekciju prevara.
- **Rukovanje greškama i JSON odgovori:** Standardizovano rukovanje greškama sa HTTP kodovima odgovora.
- **Upravljanje sesijama:** Sigurno pokretanje korisničkih sesija.

---

## Struktura Projekta

```
/src
│── App
│   ├── Validators
│   │   ├── EmailValidator.php
│   │   ├── PasswordValidator.php
│   │   ├── ValidatorInterface.php
│   ├── Database
│   │   ├── Database.php
│   ├── Services
│   │   ├── UserService.php
│   │   ├── UserServiceInterface.php
│   │   ├── FraudCheckService.php
│   ├── Responses
│   │   ├── JsonResponse.php
│── public
│   ├── index.php
│── vendor/
│── composer.json
│── README.md
```

---

## Moguća Unapređenja
- Implementacija prave **MaxMind API** provere za detekciju prevara.
- Dodavanje **unit testova** za validatore i servise.
- Korišćenje **JWT autentifikacije** umesto sesija.

---

## Licenca
MIT Licenca.

