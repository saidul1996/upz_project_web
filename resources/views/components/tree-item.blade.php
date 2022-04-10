@props(['item','placement','team'])

<div class="w-full flex justify-center relative" x-data="{ tooltip: false }">
    @if($item['id'])
        <div x-show="tooltip" class="p-1 px-4 rounded bg-black text-white text-center absolute init-hidden hidden" style="bottom: 100%;">
            Name : {{ $item['username']}}<br/>
            placement : {{ $item['placement'] ?? ''}}<br/>
            Team A : {{ $item['left_count'] }}<br/>
            Team B : {{ $item['middle_count'] }}<br/>
            Team C : {{ $item['right_count'] }}<br/>
        </div>
    @endif
    <div class="text-center p-2 relative @if(!$item['id']) opacity-50 @endif">
        @if($item['id'])
            <a
                class="absolute top-0 bottom-0 left-0 right-0"
                href="{{ route('user.tree', ['user' => $item['id']]) }}"
                x-on:mouseover="tooltip = true" x-on:mouseout="tooltip = false"
            ></a>
        @else
            <a class="absolute top-0 bottom-0 left-0 right-0" href="{{ route('user.create', ['placement' => $placement,'team' => $team]) }}"></a>
        @endif
        <div class="p-1 border border-gray-500 rounded">
            <img class="h-24 w-24" src="{{ $item['avatar'] ? ('/storage/'.$item['avatar']) : \App\Models\User::$imageFields['avatar']['placeholder'] }}" alt="Avatar of {{ $item['username'] }}"/>
        </div>
        <div class="py-1 text-center">{{ $item['username'] }}</div>
    </div>
</div>
