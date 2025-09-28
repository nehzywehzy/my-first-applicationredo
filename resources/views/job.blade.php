<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <h2 class="font-bold text-xl mb-2">{{ $job['title'] }}</h2>
    <p class="text-gray-700">
        This job pays <span class="font-semibold">{{ $job['salary'] }}</span> per year.
    </p>
</x-layout>
