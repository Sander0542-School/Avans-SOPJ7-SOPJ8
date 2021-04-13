<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <form method="POST" action="/admin/layers/">
        @csrf
        <input type="text" name="name" />
        <textarea name="body"></textarea>
        <button type="submit">Save</button>
    </form>
</x-app-layout>
