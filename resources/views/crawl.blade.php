
@foreach ($produits as $produit)
<div class="post">
   <p class="post__title">{{$produit->nom}}</p>
   <picture>
      <img src="{{$produit->img}}">
   </picture>

</div>
@endforeach