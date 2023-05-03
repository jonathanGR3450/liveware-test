@csrf

<div class="space-y-4">
    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">
            Firstname
        </span>
        <input
            class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80 text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700 focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400"
            name="first_name" id="first_name" type="text"
            value="{{ old('first_name', $employee?->present()->getFirstName()) }}">
        @error('first_name')
            <small class="font-bold text-red-500/80">{{ $message }}</small>
        @enderror
    </label>
    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">
            Lastname
        </span>
        <input
            class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80 text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700 focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400"
            name="last_name" id="last_name" type="text"
            value="{{ old('last_name', $employee?->present()->getLastName()) }}">
        @error('last_name')
            <small class="font-bold text-red-500/80">{{ $message }}</small>
        @enderror
    </label>

    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">
            Department
        </span>
        <input
            class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80 text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700 focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400"
            name="department" id="department" type="text"
            value="{{ old('department', $employee?->present()->getDepartment()) }}">
        @error('department')
            <small class="font-bold text-red-500/80">{{ $message }}</small>
        @enderror
    </label>
    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">
            Email
        </span>
        <input
            class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80 text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700 focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400"
            name="email" id="email" type="email"
            value="{{ old('email', $employee?->present()->getEmail()) }}">
        @error('email')
            <small class="font-bold text-red-500/80">{{ $message }}</small>
        @enderror
    </label>

    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">
            Password
        </span>
        <input
            class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80 text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700 focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400"
            name="password" id="password" type="password"
            value="">
        @error('password')
            <small class="font-bold text-red-500/80">{{ $message }}</small>
        @enderror
    </label>

    <label for="has_access" class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">
            * Has Access
        </span>
        <select id="has_access" name="has_access"
            class="block w-full py-2 pl-3 pr-10 mt-1 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
            <option
                {{ !$employee?->present()->getHasAccess() == 'SI' && !$employee?->present()->getHasAccess() == 'NO' ? 'selected' : '' }}>
                Choose...</option>
            <option {{ $employee?->present()->getHasAccess() == 'SI' ? 'selected' : '' }} value="1">YES</option>
            <option {{ $employee?->present()->getHasAccess() == 'NO' ? 'selected' : '' }} value="0">NO</option>
        </select>
    </label>

</div>
<div class="space-y-4">
    <label class="flex flex-col">
        <span class="font-serif text-slate-600 dark:text-slate-400">
            Avatar
        </span>
        <input
            class="rounded-md shadow-sm border-slate-300 dark:bg-slate-900/80 text-slate-600 dark:text-slate-400 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800 focus:ring-opacity-50 dark:focus:border-slate-700 focus:border-slate-300 dark:bg-slate-800 dark:border-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400"
            autofocus="autofocus" type="file" id="img_file" name="img_file"
            accept="image/*">
        @error('img_file')
            <small class="font-bold text-red-500/80">{{ $message }}</small>
        @enderror
    </label>
</div>

<div class="flex items-center justify-between mt-4">
    <a class="inline-flex items-center px-4 py-2 text-xs bg-red-500 font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-2 border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-700 focus:outline-none focus:border-sky-500"
        href="{{ route('employees.index') }}">
        Cancelar
    </a>

    <button
        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-2 border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-700 focus:outline-none focus:border-sky-500"
        type="submit">
        {{ $btnAction }}
    </button>

    <input type="hidden" name="id" value="{{ $employee?->id ?? '0' }}">
</div>
