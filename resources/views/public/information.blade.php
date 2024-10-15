<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">{{ $information->title }}</h1>
                    <div class="mt-4">
                        <p>{!! $information->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>