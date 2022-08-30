<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E- tiket</title>
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
    <p>E-tiket</p>
    @foreach ($data as $d)
        <table>
            <thead>
                <tr>
                    <th>Nama maskapai</th>
                    <th>Nama pemesan</th>
                    <th>Nomor Whatsapp</th>
                    <th>Kode booking</th>
                    <th>Kode kursi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $d->jadwal->maskapai->nama_maskapai }}</td>
                    <td>{{ $d->nama_pemesan }}</td>
                    <td>{{ $d->nomor_whatsapp }}</td>
                    <td>{{ $d->kode_booking }}</td>
                    <td>K-{{ $d->jadwal->jumlah_kursi - $d->jumlah_penumpang }}</td>
                </tr>    
            </tbody> 
        </table>
    @endforeach
</body>
</html>