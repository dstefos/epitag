<div class="container" style="overflow: hidden;">
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(count($cards)==0) There are no cards @endif
    @foreach($cards as $index=>$card)
        <div class="card-box @if($card->price>\Auth::user()->balance) disabled @endif">
            <h4>{{$card->title}}</h4>
            <span>Seller: <b>{{App\Models\User::find($card->user_id)->name}}</b></span>
            <img src="@if($card->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$card->image)}} @endif" alt=""> <br>
            <span class="price">Price: <b>${{$card->price}}</b></span> <br>
            @if($card->price>\Auth::user()->balance) <b style="color:red;">Insufficient Funds</b> <br> 
            @else
            <button class="btn btn-danger" wire:click="buy({{$card->id}})">BUY</button><br>
            @endif
        </div>
    @endforeach
</div>
