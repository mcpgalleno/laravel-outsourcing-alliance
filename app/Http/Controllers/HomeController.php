<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;

class HomeController extends Controller
{

    protected $data;
    
    public function __construct(){
        $this->data['page_title'] = '';
    }

    public function home(Request $request) {
        $this->data['page_title'] = 'Home';
        return view('welcome', $this->data);
    }
}
