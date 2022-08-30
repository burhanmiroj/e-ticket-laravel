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
    </style>
</head>
<body>
    <p>E-tiket</p>
    <div style="display: flex;">
        <div style="display: flex;">
            <img style="width: 100px;" src="{{ asset('storage/maskapai/'. $maskapai->logo_maskapai) }}" alt="">
            <div style="margin-left: 1rem;">
                <p>{{ $maskapai->nama_maskapai }}</p>
                <p>{{ Str::upper($order->kelas_penerbangan) }}</p>
            </div>
        </div>
    
        <div style="margin-left: 3rem">
            <p>{{ $order->nama_pemesan }}</p>
            <p>{{ $order->nomor_whatsapp }}</p>
        </div>
    </div>
    <div style="display: flex; aligh-items: center; margin-top: 3rem;">
        <div>
            <p>Berangkat dari</p>
            <p>{{ Str::upper($order->kota_asal) }}</p>
        </div>
        <div style="margin-left: 1rem;">
            <p>Kota tujuan</p>
            <p>{{ Str::upper($order->kota_tujuan) }}</p>
        </div>
    </div>
    {{-- <p>Total pesanan : {{ number_format($total_harga) }}</p> --}}
    {{-- @foreach ($maskapai as $m) --}}
        {{-- {{ $maskapai->id }} --}}
    {{-- @endforeach --}}
</body>
</html>