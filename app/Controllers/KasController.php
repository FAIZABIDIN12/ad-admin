<?php

namespace App\Controllers;

use App\Models\KasModel;
use CodeIgniter\Controller;

class KasController extends Controller
{
    public function index()
    {
        return view('admin/kas/index');
    }
}
