
<div class="container" style="overflow: hidden;">
<h3>Available bundles for purchase</h3>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@if (session()->has('cards'))
    <div class="alert alert-cards">
        Bundle bought succesfully. <br>
        Cards obtained: <br>
        @foreach(session('cards') as $card)
            @livewire('card', ['options'=>[
                "product"=>$card,
                "productTitle"=>$card->title,
                "productLabel"=>false,
                "productInfoLabel"=>"Seller",
                "productInfoData"=>App\Models\User::find($card->user_id)->name,
                "productImgSrc"=>asset('storage/'.$card->image),
                "productImgAlt"=>"Card Image",
                "productPriceVisible"=>false,
                "productPrice"=>$card->price,
                "productInput"=>false,
                "productIndex"=>0,
                "productNotAvailable"=>false,
                "productInsufficientFunds"=>false,
                "productBtnBuy"=>false,
                "productBtnSell"=>false,
                "productBtnUnsell"=>false,
                "productBtnScheduleCard"=>false,
                "productBtnScheduleBundle"=>false,
                "productBtnDelete"=>false
            ]])
        @endforeach
        
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(\Auth::user()->admin)
<button class="btn btn-primary" onclick="$('#create-dialog').show('slow')">Create Bundle</button>
<div id="create-dialog" style="@if(!$showDialog)display: none;@endif">
    <form wire:submit.prevent="submit">
        @error('newTitle') <span class="error">{{ $message }}</span> @enderror
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="newTitle">Title</span>
            </div>
            <input type="text" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="newTitle" wire:model="newTitle">
        </div>

        @error('newPrice') <span class="error">{{ $message }}</span> @enderror
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="newPrice">Price</span>
            </div>
            <input type="number" step="0.01" class="form-control" placeholder="Price" aria-label="Price" aria-describedby="newPrice" wire:model="newPrice">
        </div>

        @error('newQuantity') <span class="error">{{ $message }}</span> @enderror
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="newQuantity">Quantity</span>
            </div>
            <input type="number" class="form-control" placeholder="Quantity" aria-label="Quantity" aria-describedby="newQuantity" wire:model="newQuantity">
        </div>

        @error('newImage') <span class="error">{{ $message }}</span> @enderror
        @if ($newImage)
            Photo Preview:
            <img src="{{ $newImage->temporaryUrl() }}" style="height:150px;" >
        @endif
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="newImage">Image</span>
            </div>
            <input type="file" class="form-control" placeholder="Image" aria-label="Image" aria-describedby="newImage" wire:model="newImage">
        </div>

        <button class="btn btn-success">Create</button>
    </form>
</div>
<hr>
@endif

@foreach($bundles as $bundle)
    <div class="bundle-box">
        <h4>{{$bundle->title}}</h4>
        <img src="@if($bundle->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$bundle->image)}} @endif" alt=""> <br>
        <span>Quantity: <b>{{$bundle->quantity}}</b></span> <br>
        <span class="price">Price: <b>${{$bundle->price}}</b></span> <br>
        <button class="btn btn-success" wire:click="buy({{$bundle->id}})">BUY</button><br>
        @if(\Auth::user()->admin)<button class="btn btn-danger" wire:click="delete({{$bundle->id}})">DELETE</button>@endif
    </div>

    <div class="container product-container">
        <div class="row"><span class="col-12 product-title">{{$bundle->title}}</span></div>
        <div class="row"><span class="col-12 product-label"> Quantity: <b>{{$bundle->quantity}}</b></span></div>
        <div class="row"> <img class="col-12 product-image" src="@if($bundle->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$bundle->image)}} @endif" alt="Bundle Image"></div>
        <div class="row"><span class="col-12 product-price"> Price <b>${{$bundle->price}}</b></span></div>
        @if(\Auth::user()->balance<$bundle->price)<div class="row"><span class="col-12"><b style="color:red;">Insufficient Funds</b></b></span></div>
        @else<div class="row"> <div class="col-12"> <button class="form-control btn btn-success btn-sm" wire:click="$emit('buy', {{$bundle->id}})">BUY</button></div></div>@endif
        <div class="row"> <div class="col-12"> <button class="button form-control btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="$('#bundleId').val({{$bundle->id}});">Schedule</button></div></div>
        @if(\Auth::user()->admin)<div class="row"> <div class="col-12"> <button class="form-control btn btn-danger btn-sm" wire:click="delete({{$bundle->id}})">DELETE</button></div></div>@endif
    </div>
@endforeach
</div>
