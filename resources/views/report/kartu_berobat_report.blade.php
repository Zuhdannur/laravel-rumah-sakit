<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Berobat</title>
    <style>
        .title {
            width: 100%;
            text-align: center;
        }


        .content {
            width: 100%;
        }

        .headers {
            background-color: grey;
            padding: 1rem;
            margin-top: 4px;
            font-size: 13px;
            text-align: center;
        }

        .headers2 {
            background-color: white;
            padding: 1rem;
            border: 1px solid black;
            margin-top: 4px;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="title">
    <div style="border: 1px solid black;border-radius:8px;padding: 1rem">
        <b>KLINIK GARUDA YAKSA</b><br>
        <small style="font-size: 10px">Jl. Gunung Batu, Kp Gunung Batu, Bojong Koneng</small>
    </div>
</div>
<div class="content">
    <div class="headers">
        <b style="color: white"> KARTU BEROBAT</b>
    </div>
    <div style="padding: 1rem;border: 1px solid black;font-size:15px ">
        <table>
            <tr>
                <td>No.RM</td>
                <td>:</td>
                <td>{{ @$query->pasien->no_rm  }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $query->pasien->nama_pasien }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $query->pasien->tgl_lahir->format('d M Y') }}</td>
            </tr>
            <tr>
                <td>
                    alamat
                </td>
                <td>:</td>
                <td>{{ $query->pasien->alamat }}</td>
            </tr>
            <tr>
                <td>Nomor Telp</td>
                <td>:</td>
                <td>{{ $query->pasien->nomor_telp }}</td>
            </tr>
        </table>
    </div>
    <div class="headers2">
        <b style="color: black"> HARUS DIBAWA SETIAP BEROBAT</b>
    </div>
</div>
</body>
</html>
