<div class="container">
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
<h3>Available Users</h3>
    <table style="width: 100%;">
        <tr>
            <th><a wire:click="sortBy('name')">Name</a></th>
            <th><a wire:click="sortBy('email')">email</a></th>
            @if(\Auth::user()->admin)<th><a wire:click="sortBy('balance')">Balance</a></th>@endif
            <th><a wire:click="sortBy('cards')">Cards</a></th>
            <th>Rank</th>
            <th><a wire:click="sortBy('created_at')">Since</a></th>
            @if(\Auth::user()->admin)<th></th>@endif
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user['name']}}</td>
                <td><a href="mailto:{{$user['email']}}">{{$user['email']}}</a></td>
                @if(\Auth::user()->admin)<td>{{$user['balance']}}</td>@endif
                <td><a href="/usercards/{{$user['id']}}">{{$user['cards']}}</a></td>
                <td>@if($user['admin'])Admin @else User @endif</td>
                <td>{{$user['created_at']}}</td>
                @if(\Auth::user()->admin)<td>
                    <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Operations
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <input type="text" wire:model.defer="newPassword" placeholder="Type password here..." class="dropdown-item form-control">
                        <a class="dropdown-item" wire:click="updatePassword({{$user['id']}})" href="#">Update Password</a>
                        <a class="dropdown-item-delete dropdown-item" wire:click="deleteUser({{$user['id']}})" href="#">Delete</a>
                    </div>
                    </div>
                </td>@endif
            </tr>
        @endforeach
    </table>
</div>
