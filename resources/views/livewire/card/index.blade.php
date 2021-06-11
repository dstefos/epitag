
<div class="container" style="overflow: hidden;">
@if(count($cards)==0) There are no cards @endif
@foreach($cards as $index=>$card)
    <div class="card-box @if($card->sellable) sellable @endif">
        <span>{{$card->title}}</span>
        @if(\Auth::user()->admin)<span>Owner: <b>@if($card->user_id==null) NONE @else {{App\Models\User::find($card->user_id)->name}} @endif</b></span>@endif
        <img src="@if($card->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$card->image)}} @endif" alt=""> <br>
        <span class="price">Price: <b>$</b><input class="form-control" wire:model="cards.{{$index}}.price" type="number" step="0.01" value="{{$card->price}}" @if($card->sellable) disabled @endif> </span>
        @if($card->sellable)
            <button class="btn btn-danger" wire:click="unsell({{$card->id}})">UNSELL</button><br>
        @else
            <button class="btn btn-success" wire:click="sell({{$card->id}}, {{$index}})">SELL</button><br>
        @endif
        @if(\Auth::user()->admin)<button class="btn btn-danger" wire:click="delete({{$card->id}})">DELETE</button>@endif
    </div>
@endforeach
</div>
