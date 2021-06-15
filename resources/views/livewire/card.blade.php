<div class="container product-container">
    <div class="row"><span class="col-12 product-title">{{$productTitle}}</span></div>
    @if($productLabel)<div class="row"><span class="col-12 product-label"> {{$productInfoLabel}}: <b>{{$productInfoData}}</b></span></div>@endif
    <div class="row"> <img class="col-12 product-image" src="{{$productImgSrc}}" alt="{{$productImgAlt}}"></div>
    @if($productPriceVisible)<div class="row"><span class="col-12 product-price"> Price <b>${{$productPrice}}</b></span></div>@endif
    @if($productInsufficientFunds)<div class="row"><span class="col-12"><b style="color:red;">Insufficient Funds</b></b></span></div>@endif
    @if($productNotAvailable)<div class="row"><span class="col-12"><b style="color:red;">Not available</b></span></div>@endif
    @if($productInput)<div class="row"><div class="col-12"> <input class="form-control" type="number" step="0.01" min=0></div></div>@endif
    @if($productBtnBuy)<div class="row"> <div class="col-12"> <button class="form-control btn btn-success btn-sm" wire:click="$emit('buy', {{$product->id}})">BUY</button></div></div>@endif
    @if($productBtnUnsell)<div class="row"> <div class="col-12"> <button class="form-control btn btn-danger btn-sm" wire:click="unsell({{$product->id}})">UNSELL</button></div></div>@endif
    @if($productBtnSell)<div class="row"> <div class="col-12"> <button class="form-control btn btn-success btn-sm" wire:click="sell({{$product->id}}, {{$productIndex}})">SELL</button></div></div>@endif
    @if($productBtnScheduleCard)<div class="row"> <div class="col-12"> <button class="button form-control btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="$('#cardId').val({{$product->id}});">Schedule</button></div></div>@endif
    @if($productBtnScheduleBundle)<div class="row"> <div class="col-12"> <button class="button form-control btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="$('#bundleId').val({{$product->id}});">Schedule</button></div></div>@endif
    @if($productBtnDelete)<div class="row"> <div class="col-12"> <button class="form-control btn btn-danger btn-sm" wire:click="$emit('delete',{{$product->id}})">DELETE</button></div></div>@endif
</div>