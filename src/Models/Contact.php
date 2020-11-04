<?php

namespace App\Models;

use App\Model;

class Contact extends Model
{

    protected static string $table = 'contacts';

    public string $name;
    public string $surname;
    public string $phone_number;
    public string $email;
    public string $picture;

}