<x-layout>
    <h1 class="text-2xl font-bold mb-6">Edit Job</h1>

    <form method="POST" action="/jobs/{{ $job->id }}" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- Title -->
        <div>
            <label class="block font-semibold">Job Title</label>
            <input type="text" name="title" 
                   value="{{ old('title', $job->title) }}"
                   class="w-full border rounded-lg p-2">
            @error('title') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Salary -->
        <div>
            <label class="block font-semibold">Salary</label>
            <input type="number" name="salary" 
                   value="{{ old('salary', $job->salary) }}"
                   class="w-full border rounded-lg p-2">
            @error('salary') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Employer -->
        <div>
            <label class="block font-semibold">Employer</label>
            <select name="employer_id" class="w-full border rounded-lg p-2">
                @foreach($employers as $employer)
                    <option value="{{ $employer->id }}" 
                        {{ $job->employer_id == $employer->id ? 'selected' : '' }}>
                        {{ $employer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tags -->
        <div>
            <label class="block font-semibold">Tags</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               {{ in_array($tag->id, old('tags', $job->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <span>{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            ✅ Update Job
        </button>
    </form>
</x-layout>
