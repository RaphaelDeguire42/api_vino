<form method="post">
@csrf
    <label for="nombreBouteille">
        Nombre de bouteilles à importer
    </label>
    <input type="number" min="1" name="nombreBouteille">
    <button type="submit">Ajouter les bouteilles</button>
</form>