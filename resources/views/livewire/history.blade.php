<div>
    <div class="max-w-xl px-8 py-4 mx-auto bg-white rounded shadow dark:bg-slate-800">
        <div class="space-y-4">
            <label>
                Initial Access date
                <input type="date" wire:model="searchInitDate">
            </label>
            <br>
            <label>
                Final Access date
                <input type="date" wire:model="searchEndtDate">
            </label>

        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Employee ID
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Created at
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($histories as $history)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $history->present()->getEmployeeId() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $history->present()->getCreatedAt() }}</td>
                </tr>
            @empty
                No hay informacion
            @endforelse
        </tbody>
    </table>
</div>
