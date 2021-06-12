<div class="container" style="overflow: hidden;">
    <h3>{{$user->name}}</h3>
    Contact: <b><a href="mailto:{{$user->email}}">{{$user->email}}</a></b> <hr>
    Cards owned: <br>
    @livewire('cards-trade', ['cards' => $cards])
</div>