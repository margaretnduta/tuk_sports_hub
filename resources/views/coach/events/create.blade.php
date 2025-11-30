<x-app-layout>
  <div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-primary mb-4">Create Event</h1>

    @if($errors->any())
      <div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">
        <strong>There were some problems with your input:</strong>
        <ul class="mt-2 list-disc pl-5">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('coach.events.store') }}" enctype="multipart/form-data" class="space-y-4">
      @csrf

      <x-input-label for="title" value="Title" />
      <x-text-input id="title" name="title" class="w-full" required value="{{ old('title') }}" />

      <x-input-label for="sport_type" value="Sport Type" />
      <x-text-input id="sport_type" name="sport_type" class="w-full" required value="{{ old('sport_type') }}" />

      <x-input-label for="starts_at" value="Starts At" />
      <x-text-input id="starts_at" name="starts_at" type="datetime-local" class="w-full" required
                    value="{{ old('starts_at') }}" />

      <x-input-label for="ends_at" value="Ends At (optional)" />
      <x-text-input id="ends_at" name="ends_at" type="datetime-local" class="w-full"
                    value="{{ old('ends_at') }}" />

      <x-input-label for="location" value="Location" />
      <x-text-input id="location" name="location" class="w-full" required value="{{ old('location') }}" />

      <x-input-label for="description" value="Description" />
      <textarea id="description" name="description" class="w-full rounded border-gray-300">{{ old('description') }}</textarea>

      <x-input-label for="cover_image" value="Cover Image" />
      <input id="cover_image" name="cover_image" type="file" accept="image/*"
             class="block w-full rounded border-gray-300" />

      <x-primary-button class="mt-4">Save</x-primary-button>
    </form>
  </div>
</x-app-layout>
