<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Tiket</title>
    <style>
        body {
            font-family: sans-serif
        }
        table tr {
            padding-left: 1rem !important;
        }
        .bordered {
            border-bottom: 1px solid #000;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header .left, .header .right {
            width: 50%;
        }
    </style>
</head>
<body>
    @php
        $d = \App\Models\Order::latest()->first();
    @endphp
    <div class="header">
        <div style="float: left;">
            <p style="font-weight: 900; font-size: 2em; font-family: sans-serif;">E-ticket</p>
            <p>Divis Airlines</p>
            <p>Booking ID : {{ $d->kode_booking }}</p>
        </div>
        <div style="float: right; margin-top: 2rem;">
            <img src="{{ public_path('logo.png') }}" style="width: 80px;" alt="">
        </div>
    </div>
    <div class="bordered" style="margin-top: 12rem"></div>
    <div style="padding-top: 2rem;">
        <table>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ public_path('storage/maskapai/'. $d->jadwal->maskapai->logo_maskapai) }}" style="width: 50px;" alt="">
                        <p>{{ $d->jadwal->maskapai->nama_maskapai }}</p>
                        <p style="margin-top: -1rem;">{{ $d->jadwal->nomor_penerbangan }}</p>
                    </td>
                    <td style="padding-left: 2rem;">
                        <span style="transform: translateY(.5rem); font-size: .8em;">Nama pemesan</span>
                        <p style="font-size: .9em; text-transform: uppercase;">{{ $d->nama_pemesan }}</p>
                    </td>
                    <td style="padding-left: 2rem;">
                        <span style="transform: translateY(.5rem); font-size: .8em;">Jumlah kursi</span>
                        <p style="font-size: .9em; text-transform: uppercase;">{{ $d->jumlah_penumpang }}</p>
                    </td>
                    <td style="padding-left: 2rem;">
                        <span style="transform: translateY(.5rem); font-size: .8em;">Rute</span>
                        <p style="font-size: .9em; text-transform: uppercase;">{{ $d->jadwal->kota_asal }} - {{ $d->jadwal->kota_tujuan }}</p>
                    </td>
                </tr>    
            </tbody> 
        </table>
        <div style="margin-top: 2rem;">
            <p style="font-size: .7em; color: #ff0000; text-transform: italic;">Gunakan Booking ID sebagai id untuk melakukan check-in</p>
        </div>
    </div>
</body>
</html>