<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <style>
        .customer {
            padding-left: 500px;
        }
        footer { position: fixed; bottom: 130px; left: 0px; right: 0px; height: 50px; }
    </style>
    @yield('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <table style="border:0;" width="100%">
        <tr>
            <td>
                <img src="{{ public_path('/images/logo/segargroup.png')}}" width="120px" height="120px">
            <td width=100%>
                <ul style="list-style-type:none;">
                    <li><span class="text"><b>Segar Kumala Indonesia</b></span></li>
                    <li><span class="text">Jln. Sutomo Simpang.Seikera No. 25D Kota medan </span></li>
                    <li><span class="text">kec.medan Timur, Sumatera Utara, Indonesia</span></li>
                    <li><span class="text">(+62-21) 4608000 | skfresh@gmail.com</span></li>
                </ul>
            </td>
        </tr>
    </table>
    <hr style="border: 1px solid;">
    @yield('content')
</body>
</html>