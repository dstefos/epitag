<div>
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
    @foreach($cards as $card)
        @livewire('card', ['options'=>[
            "product"=>$card,
            "productTitle"=>$card->title,
            "productLabel"=>true,
            "productInfoLabel"=>"Seller",
            "productInfoData"=>App\Models\User::find($card->user_id)->name,
            "productImgSrc"=>asset('storage/'.$card->image),
            "productImgAlt"=>"Card Image",
            "productPriceVisible"=>true,
            "productPrice"=>$card->price,
            "productInput"=>false,
            "productIndex"=>0,
            "productNotAvailable"=>!$card->sellable,
            "productInsufficientFunds"=>$card->price>\Auth::user()->balance,
            "productBtnBuy"=>$card->sellable,
            "productBtnSell"=>false,
            "productBtnUnsell"=>false,
            "productBtnScheduleCard"=>$card->sellable,
            "productBtnScheduleBundle"=>false,
            "productBtnDelete"=>false
        ]])
    @endforeach

    

</div>