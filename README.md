#IOT_Events_REST_API

Przetwarzanie informacji o zdarzeniach pochodzących z urządzeń IoT.
System przyjmuje informacje o pojedynczych zdarzeniach za pomocą interface'u REST.

Dla każdego wchodzącego do systemu zdarzenia, istnieje potrzeba
• walidacji składni konkretnego zdarzenia przy założeniu, że wszystkie pola w każdym
typie zdarzenia są wymagane.
• podjęcia różnych akcji dodatkowych z zależności od rodzaju zdarzenia.
Możliwe akcje do wywołania w systemie:
o zalogowanie zdarzenia (wysłanie do logu),
o wysłania SMS lub email,
o wysłania żądania REST do zewnętrznego systemu.
Odpowiednio dla:
• deviceMalfunction: zalogowanie i wysłanie email oraz sms
• temperatureExceeded: zalogowanie oraz wysłanie żądania REST
• doorUnlocked: zalogowanie i wysyłanie sms.
Należy zaprojektować i zaimplementować we frameworku Symfony rozwiązanie, które
obsłuży powyższe wymagania.
W ramach obsługi poszczególnych akcji dodatkowych nie ma potrzeby implementować
właściwej logiki (obsługa zapisu do logu, wysłanie SMS itd.), wystarczy w danym
miejscu logiki akcji print z systemu.

---

System przetestowany ręcznie w aplikacji POSTMAN wysyłając metodą POST z body zawierającym JSON dla każdego typu Eventu.
Dane testowe z JSON zostały wzięte z zadania 2.
U mnie zdarzenia są wysyłane na adres:
"http://127.0.0.1:8000/api/event"

Jeśli w zapytaniu użyto poprawnego typu danych, w odpowiedzi otrzymywana jest notka (wysłana argumentem "echo") gdzie zostanie przekazana dalsza informacja oraz JSON z całym zdarzeniem (Bez logiki, co zostało wspomniane w zadaniu).

W razie niepoprawnego typu zwracany jest błąd z informacją jaki typ danych powinno zawierać podane pole.

NOTE: po sklonowaniu repo i zainstalowaniu zależności Composer "composer install" System startuje się w terminalu z folderu projektu komendą "symfony server:start"
