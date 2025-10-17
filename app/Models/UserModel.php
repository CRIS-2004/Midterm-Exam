<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';         // Your users table
    protected $primaryKey = 'id';       // Primary key
    protected $allowedFields = [
        'name', 'email', 'password', 'role'
    ]; // Fields that can be inserted/updated
}
