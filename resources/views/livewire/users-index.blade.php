<div class="container" style="overflow: hidden;">
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
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                    </div>
                </td>@endif
            </tr>
        @endforeach
    </table>
</div>
