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

function dueDate($due_date)
{
    $current = strtotime(date('Y-m-d H:i:s'));
    $date = strtotime($due_date);

    $datediff = $date - $current;
    $difference = floor($datediff / (60 * 60 * 24));
    $result = '';

    if ($difference == 0) {
        $result = '<span class="font-weight-bold">Due Today, ' . date('h:i A', $date) . '</span>';
    } elseif ($difference > 1) {
        $result = '<span class="font-weight-bold">' . date('d F, h:i A', $date) . '</span>';
    } elseif ($difference > 0) {
        $result = '<span class="font-weight-bold">Due Tomorrow, ' . date('h:i A', $date) . '</span>';
    } else {
        $result = '<span class="font-weight-bold">' . date('d F, h:i A', $date) . '</span>';
    }

    return $result;
}

function jkp($minggu_ke, $rayon, $file)
{
    return asset("storage/jkp/minggu-ke-$minggu_ke/$rayon/$file");
}
