<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use App\Models\Format;
use App\Models\Pays;
use App\Models\Type;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dataCrawl(Request $request){
        require_once(('crawler.php'));
        $produits = Array();
        $idLastBouteille = Bouteille::max('id');
        $page = $request->nombreBouteille + $idLastBouteille + 1;
        //$page = 1;
        $nombre = 24;
        $succes = true;
        for ($i=$idLastBouteille+1; $i < $page; $i++) {
            $produit = getProduits($nombre,$i);
            $bouteilleExiste = Bouteille::where('code_saq', $produit['code_saq'])->first();

            if (!$bouteilleExiste) {
                $format = Format::firstOrCreate(['format' => $produit['format']]);
                $pays = Pays::firstOrCreate(['pays' => $produit['pays']]);
                $type = Type::firstOrCreate(['type' => $produit['type']]);

                $bouteille = new Bouteille();
                $bouteille->nom = $produit['nom'];
                $bouteille->code_saq = $produit['code_saq'];
                $bouteille->url_saq = $produit['url'];
                $bouteille->url_img = $produit['img'];
                $bouteille->prix = $produit['prix'];
                $bouteille->id_format = $format->id;
                $bouteille->id_pays = $pays->id;
                $bouteille->id_type = $type->id;

                if (!$bouteille->save()) {
                    $succes = false;
                }
            }
            else{
                $page++;
            }
        }
        return view('bouteille/retour', ['succes' => $succes]);
    }

    public function ajouteBouteille(){
        return view('bouteille/ajout');
    }
}
