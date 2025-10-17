<?php

namespace App\Controllers;
use App\Models\AnnouncementModel;

class Announcement extends BaseController
{
    // This method will load and display all announcements
    public function index()
    {
        // Load the AnnouncementModel to interact with the database
        $model = new AnnouncementModel();

        // Fetch all announcements from the database
        $data['announcements'] = $model->orderBy('created_at', 'DESC')->findAll();



        // Send data to the 'announcements' view file
        return view('announcements', $data);
    }
}
