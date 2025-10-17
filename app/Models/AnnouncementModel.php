<?php

namespace App\Models;
use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    // Table name in the database
    protected $table = 'announcements';

    // Primary key of the table
    protected $primaryKey = 'id';

    // Fields that are allowed to be inserted/updated
    protected $allowedFields = ['title', 'content', 'created_at'];
}
