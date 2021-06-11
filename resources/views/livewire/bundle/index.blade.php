
<div class="container">
<style>
    .bundle-box{
        border: solid 1px grey; margin:5px; float:left; padding:5px; text-align:center;
    }

    .bundle-box img{
        width:70px;
        margin: 0 auto;
    }

    .price b{
        color: green;
    }

    #create-dialog{
        @if(!$showDialog)display: none;@endif
        padding: 10px;
    }

</style>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<button class="btn btn-primary" onclick="$('#create-dialog').show('slow')">Create Bundle</button>
<div id="create-dialog">
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
            <img src="{{ $newImage->temporaryUrl() }}">
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
