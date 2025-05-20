<x-layouts.app>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Risks</h1>

        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <div class="mb-4">
            <a href="{{ route('risks.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Create Risk
            </a>
        </div>

        @if ($risks->isEmpty())
            <p class="text-gray-600">No risks found.</p>
        @else
            <table class="min-w-full border border-gray-300 rounded">
                <thead>
                    {{-- <tr class="bg-gray-500 text-white"> --}}
                        <th class="border border-gray-300 px-4 py-2 text-left">Risk ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Risk Category</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Identification Date</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Probability</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Impact</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($risks as $risk)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->risk_id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->risk_category }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->identification_date }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->description }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->probability }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->impact }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $risk->level }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layouts.app>
