<!DOCTYPE html>
<html lang="en">
<head>
    <title>ZP-Obrazec za {{$name}}</title>
</head>
<style>
    * {
        font-family: DejaVu Sans, serif;
        font-size: 12px;
    }

    #naslov {
        margin-bottom: 50px;
        font-size: 18px;
    }

    th {
        border: 1px solid black;
        padding: 13px 10px 13px 10px;
    }

    .flex-EMBS {
        gap: 50px;
        border: 1px solid gray;
        padding: 0 10px 100px 10px;
    }

    h3 {
        margin: 0;
    }

    table tr td {
        border: 1px solid gray;
        border-collapse: collapse;
        text-align: center;
    }

    table tr td:first-child {
        padding: 10px 20px 10px 20px;
    }

    .ime-prezime {
        padding: 10px 100px 10px 100px;
    }

    .embg {
        padding: 10px 70px 10px 70px;
    }

    .potpis {
        padding: 10px 65px 10px 65px;
    }

    #top-margin {
        margin-top: 20px;
    }

    .postiton-table tr td {
        border: none;
    }

    .padding-left {
        padding-left: 100px;
    }
</style>

<body>
<img src="images/certified-signature-logo.png" alt="Centralen Registar Logo" width="700">
<h1 id="naslov">ОБРАЗЕЦ ЗАВЕРЕН ПОТПИС - ЗП</h1>
<div class="flex-EMBS gray-border">
    <table class="postiton-table">
        <tr>
            <td><h3>ЕМБС</h3></td>
            <td>
                <div>
                    <table cellspacing="0">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </td>
            <td class="padding-left"><h3>Фирма и седиште на субјектот на упис:</h3></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="padding-left"><h3>Друштво за производство, трговија и услуги <span style="text-transform: uppercase;">{{$firm_name}}</span> ДООЕЛ {{$municipality}}</h3></td>
        </tr>
    </table>

</div>
<div>
    <h3 id="top-margin">
        Заверени потписи на лицата овластени за застапување
    </h3>

    <table cellspacing="0">
        <tr>
            <td>
                <b>
                    Реден <br/>
                    број
                </b>
            </td>
            <td class="ime-prezime"><b>Презиме и име</b></td>
            <td class="embg"><b>ЕМБГ</b></td>
            <td class="potpis"><b>Потпис</b></td>
        </tr>
        <tr>
            <td>1.</td>
            <td>{{ $name }}</td>
            <td>{{ $embg }}</td>
            <td></td>
        </tr>
        <tr>
            <td>2.</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>3.</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>4.</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>5.</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
</body>
</html>
