<style>
.card{
   width:fit-content;
   background-color: gray;
   display:flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
}
.card picture{
   width: 202px;
   display: block;
}

.card h2{
   max-width: 25ch;
   text-align:center;
}
.card a{
   color:white;
   padding: 1em;
}

</style>
@foreach ($produits as $produit)
<div class="card">
      <h2>{{$produit['nom']}}</h2>
      <picture style="width:100px;"><img style="width:100%" src="{{$produit['img']}}" alt=""></picture>
      <p><a href="{{$produit['url']}}">Voir sur SAQ.com</a></p>
</div>
@endforeach