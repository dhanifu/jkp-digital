<?php

function folderStorage(string $direktori)
{
    return asset("storage/$direktori");
}

function tanggalBulan($date)
{
    return date('d M', strtotime($date));
}

function tanggal($date)
{
    return date('d', strtotime($date));
}

function tambahTujuhHari($date)
{
    return date('Y-m-d', strtotime('+7 days', strtotime($date)));
}
