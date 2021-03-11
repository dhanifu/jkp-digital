<?php

use Illuminate\Support\Facades\Auth;

function folderStorage(string $direktori)
{
    return asset("storage/$direktori");
}

function tanggalBulan($date)
{
    return date('d F', strtotime($date));
}

function tanggal($date)
{
    return date('d', strtotime($date));
}

function tambahTujuhHari($date)
{
    return date('Y-m-d H:i:s', strtotime('+7 days', strtotime($date)));
}

function profileImage()
{
    $role = Auth::user()->roles[0]->name;
    $image = '';

    if ($role == 'admin') {
        $photo = Auth::user()->admin->photo;
        if ($photo != '') {
            $image = asset("storage/photos/$role/$photo");
        } else {
            $image = asset("image/default-profile.png");
        }
    } elseif ($role == 'pembimbing') {
        $photo = Auth::user()->pembimbing->photo;
        if ($photo != '') {
            $image = asset("storage/photos/$role/$photo");
        } else {
            $image = asset("image/default-profile.png");
        }
    } elseif ($role == 'student') {
        $photo = Auth::user()->student->photo;
        if ($photo != '') {
            $image = asset("storage/photos/$role/$photo");
        } else {
            $image = asset("image/default-profile.png");
        }
    }

    return $image;
}

function getName()
{
    $role = Auth::user()->roles[0]->name;
    $name = '';

    if ($role == 'admin') {
        $name = Auth::user()->admin->name;
    }
    if ($role == 'pembimbing') {
        $name = Auth::user()->pembimbing->name;
    }
    if ($role == 'student') {
        $name = Auth::user()->student->name;
    }

    return $name;
}

function getEmail()
{
    $role = Auth::user()->roles[0]->name;
    $email = '';

    if ($role == 'admin') {
        $email = Auth::user()->email;
    }
    if ($role == 'pembimbing') {
        $email = Auth::user()->email;
    }
    if ($role == 'student') {
        $email = Auth::user()->email;
    }

    return $email;
}
