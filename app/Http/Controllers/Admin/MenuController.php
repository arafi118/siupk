<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $menu = Menu::where(function ($query) use ($kec) {
    $query->where('lokasi', '0')
          ->orWhere(function ($query) use ($kec) {
              $query->where('lokasi', 'LIKE', "%-{$kec['id']}-%");
          });
})->where('parent_id', '0')->get();

        $title = 'Pengaturan Menu';
        return view('admin.menu.index')->with(compact('title'));
    }
}
