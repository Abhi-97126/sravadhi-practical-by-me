<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table_name = "users";
    protected $fillable = ['first_name', 'last_name', 'contact', 'email', 'company_name', 'gst_no', 'address_1', 'address_2', 'city', 'state'];
}
