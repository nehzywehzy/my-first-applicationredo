<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>

    <form method="POST" action="/jobs" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf

        <!-- Job Title -->
        <div class="mb-4">
            <label class="block font-semibold mb-2">Job Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border border-gray-300 rounded-lg p-2">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Salary -->
        <div class="mb-4">
            <label class="block font-semibold mb-2">Salary ($)</label>
            <input type="number" name="salary" value="{{ old('salary') }}" step="0.01" min="0"
                class="w-full border border-gray-300 rounded-lg p-2">
            @error('salary')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <!-- Employer -->
        <div class="mb-4">
            <label class="block font-semibold mb-2">Employer</label>
            <select name="employer_id" class="w-full border border-gray-300 rounded-lg p-2">
                <option value=""></option>
                @foreach ($employers as $employer)
                    <option value="{{ $employer->id }}" {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
                        {{ $employer->name }}
                    </option>
                @endforeach
            </select>
            @error('employer_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tags -->
<div class="mb-4">
    <label class="block font-semibold mb-2">Tags</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach ($tags as $tag)
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                       {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                <span>{{ $tag->name }}</span>
            </label>
        @endforeach
    </div>
    @error('tags')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        <!-- Submit -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Create Job
        </button>
    </form>
</x-layout>
