<div class="container mx-auto p-4">

    <div class="bg-white shadow-md rounded-md p-6">
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('track-complaint.submit') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="reference_id" class="block text-sm font-medium text-gray-700">
                    {{ __('Reference ID') }}
                </label>
                <input type="text" id="reference_id" name="reference_id" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="{{ __('Enter your reference ID') }}">
            </div>

            <div>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    {{ __('Track') }}
                </button>
            </div>
        </form>
    </div>
</div>
