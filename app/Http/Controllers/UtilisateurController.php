<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilisateurController extends UserController
{
    /*
    * Page d'affichage de la liste des utilisateurs.
    */
    public function afficherListe()
    {
        return parent::index();
    }

    /*
    * Affiche les détails d'un utilisateur spécifique.
    */
    public function Afficher(Request $request, User $user)
    {
        return parent::show($request, User $user);
    }

    /*
    * Enregistre un nouvel utilisateur.
    */
    public function Enregistrer(Request $request, User $user)
    {
        return parent::store($request, $user);
    }


    /*
    * Met à jour les informations d'un utilisateur spécifique.
    */
    public function miseAJour(Request $request, User $user)
    {
        return parent::update($request, $user);
    }

    
    
    /*
    * Supprime un utilisateur spécifique.
    */
    public function supprimer(Request $request, User $user)
    {
        return parent::destroy($request, $user);
    }


}
