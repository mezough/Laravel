<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Categorie;
use App\Models\Plat;
use App\Models\Chef;

class PlatController extends Controller
{
    public function menu() {
        return view('plat.menu');
    }
    public function frmPlat() {
        $categories = Categorie::all();
        $chefs = Chef::all();
        return view('plat.creerplat',['listecategories' => $categories, 'chefs'=>$chefs]);
    }
    public function addPlat() {
        // dd(request('idChef'));
        $plat = \App\Models\Plat::create([
            'nom' => request('libelle'),
            'prix' => request('prix'),
            'composition' => request('composition'),
            'photo' => 'menu-item-1.png',
            'categorie_id' => request('idCat'),
        ]);
        $plat->save();
        $plat->chefs()->sync(request('idChef'));
        $message = "Le plat {$plat->id} - {$plat->nom} a été créé avec success"; 
        return redirect()->route('plat.frm')->with('success',$message);
    }
    public function listerPlat() {
        $plats = Plat::all();
        return view('plat.listerplats',['plats'=>$plats]);
    }
}
