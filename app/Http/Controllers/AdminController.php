<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use App\Models\Erreur;
use App\Models\Format;
use App\Models\Pays;
use App\Models\Type;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function dataCrawl(Request $request){
        require_once(('crawler.php'));
        $idLastBouteille = Bouteille::max('id');
        $page = $request->nombreBouteille + $idLastBouteille + 1;
        $nombre = 24;
        $succes = true;
        for ($i=$idLastBouteille+1; $i < $page; $i++) {
            $produit = getProduits($nombre,$i);
            $bouteilleExiste = Bouteille::where('code_saq', $produit['code_saq'])->first();

            if (!$bouteilleExiste) {
                // Créer des entrées si les valurs sont nouvelles
                $format = Format::firstOrCreate(['format' => $produit['format']]);
                $pays = Pays::firstOrCreate(['pays' => $produit['pays']]);
                $type = Type::firstOrCreate(['type' => $produit['type']]);

                // Save la bouteille dans la db
                $bouteille = new Bouteille();
                $bouteille->nom = $produit['nom'];
                $bouteille->code_saq = $produit['code_saq'];
                $bouteille->url_saq = $produit['url'];
                $bouteille->url_img = $produit['img'];
                $bouteille->prix = $produit['prix'];
                $bouteille->id_format = $format->id;
                $bouteille->id_pays = $pays->id;
                $bouteille->id_type = $type->id;
                $bouteille->save();
            } else {
                $page++;
            }
        }
        return redirect()->route('bouteille.index')->with('success', "Bouteilles importées !");
    }

    public function nouvelleErreur(Request $request){
        $erreur = new Erreur();
        $erreur->erreur = $request->erreur;;
        $erreur->save();
    }

}
