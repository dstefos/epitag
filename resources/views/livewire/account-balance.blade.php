<span>
  Balance:
</span>
<div class="dropdown show">
  <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    $ <span wire:model="balance">{{$balance}}</span>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center; padding:5px; displ">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">$</span>
      </div>
      <input type="number" min="0" step="0.01" class="form-control" wire:model.defer="newBalance" placeholder="Amount" aria-label="Amount" aria-describedby="basic-addon1">
    </div>
    <button class="btn btn-success" wire:click="deposit()">Deposit</button>
  </div>
</div>