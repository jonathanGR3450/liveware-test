<div>

    <div class="max-w-xl px-8 py-4 mx-auto bg-white rounded shadow dark:bg-slate-800">
        <div class="space-y-4">
            <label>
                ID Employee
                <input type="text" wire:model="searchId">
            </label>
            <br>
            <label>
                Department
                <input type="text" wire:model="searchDepartment">
            </label>
            <br>
            <label>
                Initial Access date
                <input type="date" wire:model="searchInitDate">
            </label>
            <br>
            <label>
                Final Access date
                <input type="date" wire:model="searchEndtDate">
            </label>
            <br>
            <label>
                Has Access
                <select wire:model="searchHasAccess"
                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                    <option value="-1" selected>Choose...</option>
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                </select>
            </label>

        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200 mt-6">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Employee ID
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Firstname
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Lastname</th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Department
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Total access
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($employees as $employee)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->present()->getId() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->present()->getFirstName() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->present()->getLastName() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->present()->getDepartment() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->present()->getAttempts() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:shadow-outline-sky"
                            href="{{ route('employee.edit', $employee->present()->getId()) }}">Update</a>
                        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white bg-red-500 uppercase transition duration-150 ease-in-out border border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:shadow-outline-sky"
                            href="#"
                            onclick="document.getElementById('{{ 'delete-employee-' . $employee->present()->getId() }}').submit()">Delete</a>
                        <a class="bg-{{ $employee->present()->getHasAccessColor() }}-500 inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:shadow-outline-sky"
                            href="#"
                            onclick="document.getElementById('{{ 'disabled-employee-' . $employee->present()->getId() }}').submit()">{{ $employee->present()->getHasAccessText() }}</a>
                        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md dark:text-sky-200 bg-sky-800 hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:shadow-outline-sky"
                            href="{{ route('employee.history', $employee->present()->getId()) }}">History</a>

                        <form class="d-none" id="{{ "delete-employee-{$employee->present()->getId()}" }}"
                            action="{{ route('employee.destroy', $employee->present()->getId()) }}" method="post">
                            @csrf @method('DELETE')
                        </form>

                        <form class="d-none" id="{{ "disabled-employee-{$employee->present()->getId()}" }}"
                            action="{{ route('employee.disabled', $employee->present()->getId()) }}" method="post">
                            @csrf
                        </form>
                    </td>
                </tr>
            @empty
                No hay informacion
            @endforelse
        </tbody>
    </table>
</div>
