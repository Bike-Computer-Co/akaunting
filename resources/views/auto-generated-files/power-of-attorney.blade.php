<!DOCTYPE html>
<html lang="en">
<head>
    <title>Polnomosno za {{$name}} </title>
</head>
<style>
    * {
        font-family: DejaVu Sans, serif;
        font-size: 12px;
    }

    h1 {
        font-size: 15px;
        text-align: center;
        padding-bottom: 0;
        padding-top: 0;
        margin-bottom: 0;
        margin-top: 0;
    }

    h2 {
        font-size: 13px;
        padding-bottom: 0;
        padding-top: 0;
        margin-bottom: 0;
        margin-top: 0;
    }

    p {
        font-size: 11px;
        padding-bottom: 0;
        padding-top: 0;
        margin-bottom: 0;
        margin-top: 0;
    }

    .center {
        display: block;
        margin-right: auto;
        margin-left: auto;
    }

    .description {
        width: 380px;
        text-align: center;
    }

</style>

<body>
<img src="images/logo-attorney-levkov.png" alt="Attorney Logo" width="700">
<h1>ПОЛНОМОШНО</h1>
<h2>Долупотпишаниот ,</h2>
<p>{{$name}} од {{$municipality}}, {{$address}} со ЕМБГ {{$embg}} и број на лична карта {{$id_number}}</p>
<br>
<p><b>ГО ОВЛАСТУВА</b> Адвокат Иван Лефков од Кочани со седиште на ул. Никола Карев бб со електронско сандаче за достава
    на:
    advokatlefkov@gmail.com со дигитален сертификат: CRT3546621 со корисничко име: Ivan Lefkov ,со сериски број
    57-F9-38-24 Издавач Makedonski Telekom CA,<b> ИМЕ И ЗА СМЕТКА НА ДОЛУПИТПИШАНИОТ :</b>
</p>
<br>

<p>-Електронски да ги подготви, завери, потпише и поднесе сите неопходни документи, за да се изврши упис на основање на
    Друштво за производство, трговија и услуги <span style="text-transform: uppercase;">{{$firm_name}}</span>
    ДООЕЛ {{$municipality}} пред Централниот регистар <br>
    -Да ја пополни и поднесе електронска пријава за упис на основањето на друштвото преку електронскиот систем на
    Централниот Регистар на РМ ако и да го подигне изготвено Решение.
</p>
<br>

<p>Адвокатот е овластен да го застапува долупотпишаниот пред судовите и други државни органи, нотарите, установи,управи,
    банки, заводи, агенции, Управата за јавни приходи, судски преведувачи, како и други правни и Физички лица, во врска
    со работата за која е погоре овластен.</p>
<br>
<p>Сегашното полномошно следува да се толкува пошироко, со оглед дека тука ополномоштениот адвокат, има право да ги
    извршуваат сите неопходни активности за завршување на горенаведената правна работа.</p>
<div style="border: 1px solid black; margin-top: 20px">
    <p><b>СО ПОТПИШУВАЊЕТО НА ОВА ПОЛНОМОШНО</b> Властодавателите изјавуваат и гарантираат дека: </p>
    <p>- Податоците и писмената кои се даваат на Адвокатот, без оглед на тоа дали истите се дадени во оригинал, заверен
        препис или фотокопија, се точни и вистинити, а Адвокатот е должен да ги прими таквите писмена во секое време од
        властодававецот и не е должен да испитува ниту одговара за нивното потекло, содржината и веродостојноста; <br>
        -Благовремено да го известуваат Адвокатот во случај на промена на доставените информации за времетраење на
        постапката: <br>
        -Согласни се личните податоци доставени до Адвокатот да бидат регистрирани, обработувани и ажурирани за
        потребите на
        Адвокатот, а согласно прописите за заштита на лични податоци: <br>
        -Согласни се Адвокатот да го задржи правото да
        побара
        и други податоци за цели на постапката: <br>
        -Согласни се Адвокатот да го задржи правото да го прекине деловниот однос во секое време: Адвокатот е овластен,
        во
        случај на спреченост или по потреба, да даде и заменичко Полномошно на друг Адвокат, Соработник и приправник.
        <br>
        -Ова Полномошно има важност се до завршување на целокупната постапка, односно до неговото отповикување; <br>
        -Сите евентуални судски и административни такси како и други оправдани трошоци на постапката,како што се за
        изготвување на печати ,нотарска заверка на зп образец и сл. се на товар на Властодавателот.
    </p>
</div>
<br>
<br>
<br>
<h4 style="float: left">{{$date}}</h4>
<div style="float: right">
    <h4>Содружник</h4>
    <p>________________________</p>
    <p>{{$name}}</p>
</div>

</body>
</html>
