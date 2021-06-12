<div class="container" style="overflow: hidden;">
<h3>
    @if(\Auth::user()->admin)
        All cards on the Database
    @else
        My cards
    @endif
</h3>
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

@if(\Auth::user()->admin)
<button class="btn btn-primary" onclick="$('#create-dialog').show('slow')">Create Card</button>
<div id="create-dialog" style="@if(!$showDialog)display: none;@endif">
    <form wire:submit.prevent="submit">
        @error('newTitle') <span class="error">{{ $message }}</span> @enderror
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="newTitle">Title</span>
            </div>
            <input type="text" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="newTitle" wire:model="newTitle">
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

@foreach($cards as $index=>$card)
    <div class="card-box @if($card->sellable) sellable @endif @if(\Auth::user()->admin) card-box-wowner @endif">
        <div class="card-title @if(\Auth::user()->admin) card-title-wowner @endif">{{$card->title}}</div>
        @if(\Auth::user()->admin)
        <div class="card-seller">
            Owner: <b>@if($card->user_id==null) NONE @else {{App\Models\User::find($card->user_id)->name}} @endif</b>
        </div>
        @endif
        <img src="@if($card->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$card->image)}} @endif" alt=""> 
        <span class="price">Price: <b>$</b><input class="form-control" wire:model="cards.{{$index}}.price" type="number" step="0.01" value="{{$card->price}}" @if($card->sellable) disabled @endif> </span>
        <div class="btn">
        </div>
        <div class="card-buy-btn">
        @if($card->sellable)
            <button class="btn btn-danger" wire:click="unsell({{$card->id}})">UNSELL</button>
        @else
            <button class="btn btn-success" wire:click="sell({{$card->id}}, {{$index}})">SELL</button>
        @endif
        @if(\Auth::user()->admin)<button class="btn btn-danger" wire:click="delete({{$card->id}})">DELETE</button>@endif
        </div>
    </div>
@endforeach
</div>
