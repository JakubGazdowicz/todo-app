## TODO-app

Opis aplikacji:

Aplikacja pozwalająca na zarządzanie użytkownikami (User), kategoriami zadań (TaskCategory) i zadaniami.
Użytkownik może tworzyć kategorie zadań, a nastepnie przypisaywać do nich zadania.
Podczas tworzenia zadania użytkownik ma mozliwość przypisania do niego osoby i określić ile minut zajmie wykonanie tego zadania.
Każda osoba ma limit 9600 minut, który resetuje się 1 dnia miesiąca

## Technologie

Wymogiem było napisanie aplikacji w technologiach: Laravel, Vue, Tailwind

Od siebie dodałem Inertia.js wraz z komponentami od PrimeVue w szablonie Sakai

Do testów wykorzystałem Pest.php

Do napisania dokumentacji użyłem biblioteki L5-Swagger, która jest dostępna pod /api/documentation

https://inertiajs.com

https://primevue.org

https://sakai.primevue.org

https://pestphp.com

https://github.com/DarkaOnLine/L5-Swagger

## Logowanie do aplikacji

login: test@example.com

hasło: password

## Instalacja

composer install

cp .env.example .env

./vendor/bin/sail up -d

./vendor/bin/sail npm install

./vendor/bin/sail php artisan key:generate

./vendor/bin/sail php artisan test

./vendor/bin/sail php artisan migrate:fresh --seed

./vendor/bin/sail npm run dev

