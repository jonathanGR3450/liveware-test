@extends('layout')

@section('title', 'usuarios')

@section('content')
    <h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Dashboard Employees</h1>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">{{ date('Y-m-d H:m:s') }}</h4>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Welcome: {{ Auth::guard('employee')->user()->first_name . ' ' . Auth::guard('employee')->user()->last_name }}</h4>
@endsection
