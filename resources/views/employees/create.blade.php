@extends('layout')

@section('content')
    <h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Administrative Menu</h1>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">{{ date('Y-m-d H:m:s') }}</h4>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Welcome: {{ Auth::user()->name }}</h4>

    <form action="{{ route('employee.store') }}" method="post" class="max-w-xl px-8 py-4 mx-auto bg-white rounded shadow dark:bg-slate-800" enctype="multipart/form-data">
        @include('employees.partials._form', ['btnAction' => 'Save'])
    </form>
@endsection
