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
            "productPrice"=>$card->price,
            "productInput"=>false,
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
    @foreach($cards as $index=>$card)
    <div class="card-box card-box-market @if($card->price>\Auth::user()->balance) disabled @endif">
        <div class="card-title">{{$card->title}}</div>
        <div class="card-seller">Seller: <b>{{App\Models\User::find($card->user_id)->name}}</b></div>
        <img src="@if($card->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$card->image)}} @endif" alt=""> 
        <div class="card-price">Price: <b>${{$card->price}}</b></div> 
        <div class="card-buy-btn">
            @if($card->price>\Auth::user()->balance) <b style="color:red;">Insufficient Funds</b>  
            @elseif($card->sellable)
            <button class="btn btn-danger" wire:click="$emit('buy', {{$card->id}})">BUY</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="$('#cardId').val({{$card->id}});">Schedule</button>
            @else
            <b style="color:red;">Not available</b>
            @endif
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">CardId:</label>
                    <input type="text" class="form-control" id="cardId" wire:model="card_id">
                </div>
                <div class="form-group">
                    On Date/Time:
                    <input placeholder="yyyy-mm-ddThh:mm" type="datetime-local" min="2020-06-01T08:30" max="2099-06-30T16:30" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" class="form-control" wire:model.defer="whenTime">
                    OR On Price Lower Than:
                    <input placeholder="$" type="number" step="0.01" class="form-control" wire:model.defer="whenPriceBigger">
                    On On Price Higher Than:
                    <input placeholder="$" type="number" step="0.01" class="form-control" wire:model.defer="whenPriceSmaller">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="Livewire.emit('resetForm')" >Close</button>
                <!-- <button type="button" class="btn btn-primary" wire:click="createTradeJob()"  data-dismiss="modal">Create</button> -->
                <button type="button" class="btn btn-primary" onclick="Livewire.emit('createTradeJob', $('#cardId').val())"  data-dismiss="modal">Create</button>
            </div>
            </div>
        </div>
    </div>

</div>