<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boarding pass</title>
    <style>
        body {
            font-family: sans-serif
        }
        table tr {
            padding-left: 1rem !important;
        }
    </style>
</head>
<body>
    @php
        $data = \App\Models\Order::where('checkin_id', Request::has('checkin_id'))->get();
    @endphp
    <p>Divis Airlines</p>
    @foreach ($data as $d)
        <div style="margin-top: 2rem; border: 1px solid #ddd; border-radius: .5rem; padding: 2rem;">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ public_path('storage/maskapai/'. $d->jadwal->maskapai->logo_maskapai) }}" style="width: 100px;" alt="">
                            <p>{{ $d->jadwal->maskapai->nama_maskapai }}</p>
                        </td>
                        <td style="padding-left: 2rem;">
                            <p style="font-size: 1.5em; text-transform: uppercase; transform: translateY(-1rem);">{{ $d->jadwal->kelas_penerbangan }}</p>
                            <span style="transform: translateY(-2rem); font-size: .8em;">CLASS</span>
                        </td>
                        <td style="padding-left: 2rem;">
                            <p style="font-size: 1.5em; text-transform: uppercase; transform: translateY(-1rem);">{{ $d->jadwal->nomor_penerbangan }}</p>
                            <span style="transform: translateY(-2rem); font-size: .8em;">NOMOR PENERBANGAN</span>
                        </td>
                        <td style="padding-left: 2rem;">
                            <p style="font-size: 1em; text-transform: uppercase; transform: translateY(-1rem);">{{ $d->jadwal->kota_asal }} - {{ $d->jadwal->kota_tujuan }}</p>
                            <span style="transform: translateY(-2rem); font-size: .8em;">RUTE</span>
                        </td>
                    </tr>    
                </tbody> 
            </table>
            <table style="padding-top: 2rem">
                <thead>
                    <tr>
                        <th style="text-align: left;">Nama</th>
                        <th style="text-align: left; padding-left: 1rem;">GATE</th>
                        <th style="text-align: left; padding-left: 1rem;">Kode booking</th>
                        <th style="text-align: left; padding-left: 1rem;">Kode kursi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: left;">{{ $d->nama_pemesan }}</td>
                        <td style="text-align: left; padding-left: 1rem;">GATE-{{ $d->jadwal->id + 1 }}</td>
                        <td style="text-align: left; padding-left: 1rem;">{{ $d->kode_booking }}</td>
                        <td style="text-align: left; padding-left: 1rem;">K-{{ $d->jadwal->jumlah_kursi - $d->jumlah_penumpang }}</td>
                    </tr>    
                </tbody> 
            </table>
        </div>
    @endforeach
</body>
</html>