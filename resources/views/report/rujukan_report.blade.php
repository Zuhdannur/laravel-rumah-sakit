<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Rujukan</title>
    <style>
        .title {
            width: 100%;
            text-align: center;
        }
        .content {
            width: 100%;
        }

         .headers {
            margin: 1rem;
             font-size: 14px;
            border: 1px solid black;
            padding: 1rem;
        }
        table {
            font-size: 12px;

        }
    </style>
</head>
<body>
    <div class="title">
        <b>Rujukan Puskesmas / Dokter Keluarga</b>
    </div>
    <div class="content">
        <div class="headers">
            <table>
                <tr>
                    <td>No . Rujukan</td>
                    <td>:</td>
                    <td>{{ $query->nomor_rujukan }}</td>
                </tr>
                <tr>
                    <td>Puskesmas/Dokter Keluarga</td>
                    <td>:</td>
                    <td>{{ $query->asal }}</td>
                </tr>
            </table>
        </div>
        <div style="padding: 1rem">
            <table>
                <tr>
                    <td>Kepada Poli</td>
                    <td>:</td>
                    <td>{{ $query->poli->nama_poli }}</td>
                </tr>
                <tr>
                    <td>Di RSU</td>
                    <td>:</td>
                    <td>{{ $query->ke }}</td>
                </tr>
            </table>
            <p style="font-size: 12px">Mohon Pemeriksaan dan penanganan lebih lanjut penderita</p>
            <table style="width: 100%">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $query->pasien->nama_pasien }}</td>
                    <td>Faskes</td>
                    <td>:</td>
                    <td> {{ @$query->pasien->faskes }}</td>
                </tr>
                <tr>
                    <td>Diagnosa</td>
                    <td>:</td>
                    <td>{{ $query->rekam_medis->diagnosis}}</td>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td> {{ @$query->pasien->tgl_lahir->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td>Status Peserta</td>
                    <td>:</td>
                    <td>{{ $query->pasien->status_peserta }}</td>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td> {{ strtoupper(@$query->pasien->jenis_kelamin) }}</td>
                </tr>
            </table>
            <p style="font-size: 12px">Demikian Surat Rujukan dimohon agar segera di lakukan tindak lanjut</p>
        </div>

    </div>
</body>
</html>
