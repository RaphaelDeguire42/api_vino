<style>

.wrapper{
    margin: 0 auto;
    width:100%;
    display: grid;
    gap: 1em;
    grid-template-columns: repeat(5, 1fr);
}
.card{
   width:fit-content;
   background-color: gray;
   display:flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   padding: 1em 0.75em;
   margin: 0.5em 0;
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
<div class="wrapper">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @foreach ($bouteilles as $bouteille)
    <div class="card">
        <h2>{{$bouteille['nom']}}</h2>
        <picture style="width:100px;"><img style="width:100%" src="{{$bouteille['url_img']}}" alt=""></picture>
        <p><a href="{{$bouteille['url_saq']}}">Voir sur SAQ.com</a></p>
    </div>
    @endforeach
</div>