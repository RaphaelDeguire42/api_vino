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
@foreach ($bouteilles as $bouteille)
<div class="card">
      <h2>{{$bouteille['nom']}}</h2>
      <picture style="width:100px;"><img style="width:100%" src="{{$bouteille['url_img']}}" alt=""></picture>
      <p><a href="{{$bouteille['url_saq']}}">Voir sur SAQ.com</a></p>
</div>
@endforeach