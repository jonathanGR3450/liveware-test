@extends('layout')

@section('content')
    <h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Administrative Menu</h1>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">{{ date('Y-m-d H:m:s') }}</h4>
    <h4 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500">Welcome: {{ Auth::user()->name }}</h4>

    <div class="max-w-xl px-8 py-4 mx-auto bg-white rounded shadow dark:bg-slate-800 mt-4">
        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:shadow-outline-sky"
            href="{{ route('employee.create') }}">Create new Employee</a>

        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:shadow-outline-sky"
            href="{{ route('employee.upload.csv') }}">Upload CSV Employees</a>

        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:shadow-outline-sky"
            id="pdf">PDF</a>
    </div>

    <main class="max-w-7xl px-8 py-4 mx-auto bg-white rounded shadow dark:bg-slate-800 mt-4">
        @livewire('dashboard')
    </main>
    @php
        $accessToken = session('access_token');
    @endphp
    <script>
        localStorage.setItem('access_token', `{{ $accessToken }}`);
        $("#clear-btn").on('click', function(e) {
            e.preventDefault();
            $("#id").val('');
            $("#department").val('');
            $("#date_init").val('');
            $("#date_end").val('');
            $("#has_access").val('');
            window.location.href = "{{ route('employees.index') }}";
        });
        $("#pdf").on('click', function(params) {
            var id = $("#id").val();
            var department = $("#department").val();
            var date_init = $("#date_init").val();
            var date_end = $("#date_end").val();
            var has_access = $("#has_access").val();
            var url = "{{ route('employee.pdf') }}" +
                `?id=${id}&department=${department}&date_init=${date_init}&date_end=${date_end}&has_access=${has_access}`;
            window.open(url);
        });
    </script>
@endsection
