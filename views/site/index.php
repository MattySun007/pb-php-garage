<?php

/* @var $this yii\web\View */

$this->title = 'Aplikacja do zarządzania flotą pojazdów';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Witamy!</h1>

        <p class="lead">Zapraszamy do korzystania z aplikacji do zarządzania pojazdami</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Samochody</h2>

                <p>Moduł Samochody (Vehicles) służy do dodawania, edytowania, usuwania i wyświetlania samochodów,
                które są w naszym posiadaniu. Dodajemy pojazd, wybierając jego typ, wielkość silnika, rok produkcji czy typ używanego paliwa.
                Ponadto jeśli dany pojazd ma być możliwy do wynajęcia, podajemy również koszt wynajmu. Następnie możemy wybrać
                ubezpieczenie OC naszego auta, jego właściciela oraz garaż, w którym stoi dany samochód.</p>

            </div>
            <div class="col-lg-4">
                <h2>Widok auta</h2>

                <p>Nasza aplikacja umożliwia wiele innych rzeczy powiązanych z autem. Można dodawać tankowania, które następnie
                zostaną zaprezentowane w widoku samochodu w przyjemnej formie wykresu, można też dodawać naprawy powiązane z autem,
                dodawać przeróżne paragony związane z pojazdem, wybierać garaż w którym stoi nasze auto itd. Ponadto gdy auto ma
                ustawiony koszt wynajmu, można wygenerować umowę najmu w formacie PDF, a dane z niej zostaną zapisane jako rekord
                w dziale Wynajmów (Rentals)</p>

            </div>
            <div class="col-lg-4">
                <h2>Inne</h2>

                <p>Dostępny jest moduł Kalendarza (Calendar), który zbiera ważne terminy związane z naszym autem i prezentuje je
                na kalendarzu. Pokazuje wydarzenia związane z kończącymi się ubezpieczeniami oraz przeglądami technicznymi naszych aut,
                dzięki czemu nigdy nie zapomnimy ich odnowić. Prócz tego warto zapozać się z modułami takimi jak Garaże (Garages), gdzie
                można dodawać garaże w których parkujemy auta, Właściciele (Owners) gdzie można dodać wielu właścicieli pojazdów,
                Części (Parts), gdzie dodajemy części używane przy naprawach oraz Warsztaty (Service Shops), gdzie dodajemy spis
                warsztatów, które serwisują nasze samochody.</p>
            </div>
        </div>

    </div>
</div>
