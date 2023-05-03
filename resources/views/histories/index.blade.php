@extends('layout')

@section('content')
    <h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">History user</h1>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">{{ date('Y-m-d H:m:s') }}</h4>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Welcome: {{ Auth::user()->name }}</h4>

    <main class="max-w-3xl px-8 py-4 mx-auto bg-white rounded shadow dark:bg-slate-800 mt-4">
        @livewire('history', ['historyId' => $id])
    </main>
@endsection
