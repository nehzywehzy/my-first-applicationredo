<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <p class="text-sm text-gray-500">{{ $job->employer->name }}</p>
    <h2 class="font-bold text-lg">{{ $job['title'] }}</h2>
    <p>
        This job pays {{ $job['salary'] }} per year.
    </p>

    <!-- Edit Button -->
    <div class="mt-4 flex space-x-2">
        <a href="{{ route('jobs.edit', $job->id) }}"
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
             Edit Job
        </a>

        <!-- Delete Button -->
        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this job?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">
                Delete Job
            </button>
        </form>
    </div>
</x-layout>
