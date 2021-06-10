
<div class="container">
<style>
    .bundle-box{
        border: solid 1px grey; margin:5px; float:left; padding:5px; text-align:center;
    }

    .bundle-box img{
        width:150px;
        margin: 0 auto;
    }

    .price b{
        color: green;
    }
</style>
@foreach($bundles as $bundle)
    <div class="bundle-box">
        <h4>{{$bundle->title}}</h4>
        <img src="/img/{{$bundle->image}}" alt=""> <br>
        <span>Quantity: <b>{{$bundle->quantity}}</b></span> <br>
        <span class="price">Price: <b>${{$bundle->price}}</b></span> <br>
        <button class="btn btn-success" wire:click="buy({{$bundle->id}})">BUY</button><br>
        @if(\Auth::user()->admin)<button class="btn btn-danger" wire:click="delete({{$bundle->id}})">DELETE</button>@endif
    </div>
@endforeach
</div>
