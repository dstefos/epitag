
<div class="container">

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
            <div class="card-box">
                {{$card->title}} <br>
                <img src="{{asset('storage/'.$card->image)}}" alt="card-container">
            </div>
        @endforeach
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
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
@foreach($bundles as $bundle)
    <div class="bundle-box">
        <h4>{{$bundle->title}}</h4>
        <img src="@if($bundle->image=='bundle.png'){{asset('storage/img/bundle.png')}} @else {{asset('storage/'.$bundle->image)}} @endif" alt=""> <br>
        <span>Quantity: <b>{{$bundle->quantity}}</b></span> <br>
        <span class="price">Price: <b>${{$bundle->price}}</b></span> <br>
        <button class="btn btn-success" wire:click="buy({{$bundle->id}})">BUY</button><br>
        @if(\Auth::user()->admin)<button class="btn btn-danger" wire:click="delete({{$bundle->id}})">DELETE</button>@endif
    </div>
@endforeach
</div>
