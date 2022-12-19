<x-mail::message>
    Blood Bank Reset Password.
    Hello {{ $user->name }}
    @isset($route)
    <x-mail::button url={{$route}}>
        Reset
        </x-mail::button>
        @else
            <x-mail::button :url="''">
           
            Reset
        </x-mail::button>
        @endisset
        <p>your reset code is {{ $user->pin_code }}</p>
        Thanks,<br>
        {{ config('app.name') }}
</x-mail::message>
