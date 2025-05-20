<x-layouts.app>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Mitigasi Risiko</h1>

    <form action="{{ route('mitigations.update', $mitigation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="mitigation_description" class="block text-gray-700 font-bold mb-2">Deskripsi Mitigasi</label>
            <textarea id="mitigation_description" name="mitigation_description" rows="4" class="w-full border border-gray-300 rounded p-2">{{ old('mitigation_description', $mitigation->mitigation_description) }}</textarea>
            @error('mitigation_description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="risk_description" class="block text-gray-700 font-bold mb-2">Deskripsi Risiko</label>
            <textarea id="risk_description" name="risk_description" rows="4" class="w-full border border-gray-300 rounded p-2">{{ old('risk_description', $mitigation->risk->description) }}</textarea>
            @error('risk_description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="probability" class="block text-gray-700 font-bold mb-2">Probabilitas</label>
            <input type="number" id="probability" name="probability" min="1" max="5" value="{{ old('probability', $mitigation->probability ?? $mitigation->risk->probability) }}" class="w-full border border-gray-300 rounded p-2">
            @error('probability')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="impact" class="block text-gray-700 font-bold mb-2">Dampak</label>
            <input type="number" id="impact" name="impact" min="1" max="5" value="{{ old('impact', $mitigation->impact ?? $mitigation->risk->impact) }}" class="w-full border border-gray-300 rounded p-2">
            @error('impact')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('mitigations.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
    </form>
</div>

</x-layouts.app>
