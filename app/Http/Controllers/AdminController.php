<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dataCrawl(Request $request){
        require_once(('crawler.php'));
        $produits = Array();
        $page = $request->nombreBouteille;
        //$page = 1;
        $nombre = 24;
        for ($i=1; $i < $page+1; $i++) {
            array_push($produits, getProduits($nombre,$i));
        }
        $succes = true;
        foreach ($produits as $produit) {
            $bouteille = new Bouteille();
            $bouteille->nom = $produit['nom'];
            $bouteille->code_saq = $produit['code_saq'];
            $bouteille->url_saq = $produit['url'];
            $bouteille->url_img = $produit['img'];
            $bouteille->prix = $produit['prix'];
            $bouteille->id_format = 1;
            $bouteille->id_pays = 1;
            $bouteille->id_type = 1;
            if (!$bouteille->save()) {
                $succes = false;
            }
        }

        return view('bouteille/retour', ['succes' => $succes]);
    }

    public function ajouteBouteille(){
        return view('bouteille/ajout');
    }
}
