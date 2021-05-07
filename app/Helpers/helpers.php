<?php

use App\Models\Rayon;
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
    $image = asset("image/default-profile.png");

    if ($role == 'admin') {
        $photo = Auth::user()->admin->photo;
        if ($photo != '') {
            $image = asset("storage/photos/$role/$photo");
        }
    } elseif ($role == 'pembimbing' || $role == 'kesiswaan') {
        $photo = Auth::user()->teacher->photo;
        if ($photo != '') {
            $image = asset("storage/photos/$role/$photo");
        }
    } elseif ($role == 'student') {
        $photo = Auth::user()->student->photo;
        if ($photo != '') {
            $image = asset("storage/photos/$role/$photo");
        }
    }

    return $image;
}

function getRole()
{
    return $role = Auth::user()->roles[0]->name;
}

function getFirstName()
{
    $fullname = getName();
    $firstname = strtok($fullname, " ");

    if (strlen($firstname) > 13) {
        return "<br>$firstname";
    }
    return $firstname;
}

function getName()
{
    $role = Auth::user()->roles[0]->name;
    $name = '';

    if ($role == 'admin') {
        $name = Auth::user()->admin->name;
    }
    if ($role == 'pembimbing' || $role == 'kesiswaan') {
        $name = Auth::user()->teacher->name;
    }
    if ($role == 'student') {
        $name = Auth::user()->student->name;
    }

    return $name;
}

function getEmail()
{
    return Auth::user()->email;
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

function jkp($minggu_ke, $rayon, $type, $file)
{
    return asset("storage/jkp/minggu-ke-$minggu_ke/$rayon/$type/$file");
}

function getRayon()
{
    $teacher_id = Auth::user()->teacher->id;
    $rayon = Rayon::where('teacher_id', $teacher_id)->get();

    return $rayon;
}

function getRayonById($id)
{
    return Rayon::find($id);
}
