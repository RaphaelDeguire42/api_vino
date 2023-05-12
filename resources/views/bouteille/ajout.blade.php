<form method="post">
    @csrf
    <div class="input-field">
        <label for="nombreBouteille">
            Nombre de bouteilles à importer
        </label>
        <input type="number" min="1" name="nombreBouteille" id="nombreBouteille">
    </div>
    <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter les bouteilles
        <i class="material-icons right"></i>
    </button>
</form>
<script>M.AutoInit();</script>