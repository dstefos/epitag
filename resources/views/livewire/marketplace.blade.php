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
        <div class="card-box card-box-market @if($card->price>\Auth::user()->balance) disabled @endif">
            <div class="card-title">{{$card->title}}</div>
            <div class="card-seller">Seller: <b>{{App\Models\User::find($card->user_id)->name}}</b></div>
            <img src="@if($card->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$card->image)}} @endif" alt=""> 
            <div class="card-price">Price: <b>${{$card->price}}</b></div> 
            <div class="card-buy-btn">
                @if($card->price>\Auth::user()->balance) <b style="color:red;">Insufficient Funds</b>  
                @else
                <button class="btn btn-danger" wire:click="buy({{$card->id}})">BUY</button>
                @endif
            </div>
        </div>
    @endforeach
</div>
