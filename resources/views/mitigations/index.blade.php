<x-layouts.app>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Risiko</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('mitigations.index') }}" class="mb-4">
        <label for="risk_id" class="block font-semibold mb-2">Filter by Risk</label>
        <select name="risk_id" id="risk_id" class="border border-gray-300 rounded p-2">
            <option value="">-- All Risks --</option>
            @foreach($risks as $risk)
                <option value="{{ $risk->id }}" {{ request('risk_id') == $risk->id ? 'selected' : '' }}>
                    {{ $risk->risk_id }} - {{ $risk->description }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
    </form>

    <table class="min-w-full border rounded border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Risk ID</th>
                <th class="border border-gray-300 px-4 py-2">Risk Description</th>
                <th class="border border-gray-300 px-4 py-2">Mitigation Description</th>
                <th class="border border-gray-300 px-4 py-2">Probability</th>
                <th class="border border-gray-300 px-4 py-2">Impact</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mitigations as $mitigation)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $mitigation->risk ? $mitigation->risk->risk_id : '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $mitigation->risk ? $mitigation->risk->description : '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $mitigation->mitigation_description ?? '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $mitigation->probability ?? ($mitigation->risk ? $mitigation->risk->probability : '-') }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $mitigation->impact ?? ($mitigation->risk ? $mitigation->risk->impact : '-') }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('mitigations.edit', $mitigation) }}" class="text-blue-600 hover:underline">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-layouts.app>
