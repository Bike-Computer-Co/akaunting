<!DOCTYPE html>
<html lang="en">
<head>
    <title>Odluka za {{$name}} </title>
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
<p style="text-indent: 45px;">
    Врз основа на член 231,232 од Законот за Трговски Друштва и точка 7 и 12 од изјавата за основање на Друштво за
    производство, трговија и услуги {{$firm_name}} ДООЕЛ содружникот {{$name}} {{$address}} {{$embg}}, државјанин на
    Р.С.Македонија денес на {{$date}} ја донесе следата:
</p>
<br>
<br>
<br>
<h1>О Д Л У К А</h1>
<br>
<div class="center description" style="margin-bottom: 20px">
    <p>-За именување на управител на друштвото со ограничена одговорност-</p>
</div>
<br>
<p style="text-align: center">Член 1</p>
<br>
<p style="text-indent: 45px;">За управител на друштвото со ограничена одговорност се
    именува {{$name}} {{$address}} {{$embg}} државјанин на Р.С.Македонија , со неограничени овластувања во застапувањето
    на неопределено време како и
    застапник во вршењето на работите во надворешно трговскиот промет.
</p>
<br>

<p style="text-align: center">Член 2</p>
<br>
<p style="text-indent: 45px;">Оваа одлука влегува во сила со денот на донесувањето.</p>
<br>
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
