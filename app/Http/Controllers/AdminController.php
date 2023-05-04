<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dataCrawl(){
        require_once(('crawler.php'));
        $produits = Array();
        $page = 5;
        $nombre = 24;
        for ($i=1; $i < $page+1; $i++) {
            array_push($produits, getProduits($nombre,$i));
        }
        return view('crawl', ['produits' => $produits]);
    }
}
