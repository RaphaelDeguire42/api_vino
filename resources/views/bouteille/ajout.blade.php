<form method="post">
@csrf
    <label for="nombreBouteille">
        Nombre de bouteilles à importer
    </label>
    <input type="number" min="1" name="nombreBouteille">
    <select name="type" id="">
        <option value="">Tous les types</option>
        <option value="blanc">Blanc</option>
        <option value="rouge">Rouge</option>
        <option value="rose">Rosé</option>
        <option value="orange">Orange</option>
        <option value="nature">Nature</option>
    </select>
    <button type="submit">Ajouter les bouteilles</button>
</form>