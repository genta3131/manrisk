<x-layouts.app>
<div class="max-w-4xl mx-auto bg-green-100 p-8 rounded-lg shadow-md relative z-50">
    <h1 class="text-3xl font-bold text-black mb-6">Create New Risk</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('risks.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="risk_id" class="block font-medium text-gray-700">Risk ID</label>
            <input type="text" name="risk_id" id="risk_id" value="{{ old('risk_id') }}" required
                class="mt-1 block w-full border border-black rounded-md p-2 text-black bg-green-50 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <div>
            <label for="status" class="block font-medium text-gray-700">Status</label>
            <select name="status" id="status" required
                class="mt-1 block w-full border border-black rounded-md p-2 text-black bg-green-50 focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div>
            <label for="risk_category" class="block font-medium text-gray-700">Risk Category</label>
            <input type="text" name="risk_category" id="risk_category" value="{{ old('risk_category') }}" required
                class="mt-1 block w-full border border-black rounded-md p-2 text-black bg-green-50 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <div>
            <label for="identification_date_range" class="block font-medium text-gray-700">Identification Date Range</label>
            <input type="text" name="identification_date_range" id="identification_date_range" value="{{ old('identification_date_range') }}"
                class="mt-1 block w-full border border-black rounded-md p-2 text-black bg-green-50 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Select date range">
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required
                class="mt-1 block w-full border border-black rounded-md p-2 text-black bg-green-50 focus:ring-2 focus:ring-green-500 focus:outline-none">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="probability" class="block font-medium text-gray-700">Probability (1-5)</label>
            <select name="probability" id="probability" required
                class="mt-1 block w-full border border-black rounded-md p-2 text-black bg-green-50 focus:ring-2 focus:ring-green-500 focus:outline-none">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('probability') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div>
            <label for="impact" class="block font-medium text-gray-700">Impact (1-5)</label>
            <select name="impact" id="impact" required
                class="mt-1 block w-full border border-black rounded-md p-2 text-black bg-green-50 focus:ring-2 focus:ring-green-500 focus:outline-none">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('impact') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit" class=" px-6 py-3 border border-green-600 bg-green-600 text-black cursor-pointer hover:bg-green-700 hover:underline focus:outline-none focus:ring-2 focus:ring-green-500 rounded">
                Submit
            </button>
            <a href="{{ route('risks.index') }}" class="px-6 py-3 border border-red-600 bg-red-600 text-black cursor-pointer hover:bg-red-700 hover:underline focus:outline-none focus:ring-2 focus:ring-red-500 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>
</x-layouts.app>
