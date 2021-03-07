<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JKP Minggu ke {{ $assignment->minggu_ke }}</title>
</head>
<body>
    <p>tanggal : {{ tanggalBulan($assignment->from_date) }} sampai {{ tanggalBulan($assignment->to_date) }}</p>
</body>
</html>