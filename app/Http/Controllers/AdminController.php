<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dataCrawl(){
        require_once(('app/crawler.php'));
        $produit = getProduits();
        return view('crawl', ['produits' => $produit]);
    }
}
