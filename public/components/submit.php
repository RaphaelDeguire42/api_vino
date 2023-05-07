<?php
use App\Models\Erreur;
use Illuminate\Support\Facades\DB;


$data = file_get_contents("php://input");
$erreur_data = json_decode($data, true)['erreur'];

$erreur = new Erreur();
$erreur->erreur = $erreur_data;

DB::transaction(function () use ($erreur) {
    $erreur->save();
});
?>