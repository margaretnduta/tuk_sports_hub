<x-app-layout>
  <div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-primary mb-4">Edit Event</h1>

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

    <form method="POST"
          action="{{ route('coach.events.update', $event) }}"
          enctype="multipart/form-data"
          class="space-y-4">
      @csrf
      @method('PUT')

      {{-- Title --}}
      <x-input-label for="title" value="Title" />
      <x-text-input id="title"
                    name="title"
                    class="w-full"
                    required
                    value="{{ old('title', $event->title) }}" />

      {{-- Sport Type --}}
      <x-input-label for="sport_type" value="Sport Type" />
      <x-text-input id="sport_type"
                    name="sport_type"
                    class="w-full"
                    required
                    value="{{ old('sport_type', $event->sport_type) }}" />

      {{-- Starts At --}}
      <x-input-label for="starts_at" value="Starts At" />
      <x-text-input id="starts_at"
                    name="starts_at"
                    type="datetime-local"
                    class="w-full"
                    required
                    value="{{ old('starts_at', optional($event->starts_at)->format('Y-m-d\TH:i')) }}" />

      {{-- Ends At --}}
      <x-input-label for="ends_at" value="Ends At (optional)" />
      <x-text-input id="ends_at"
                    name="ends_at"
                    type="datetime-local"
                    class="w-full"
                    value="{{ old('ends_at', optional($event->ends_at)->format('Y-m-d\TH:i')) }}" />

      {{-- Location --}}
      <x-input-label for="location" value="Location" />
      <x-text-input id="location"
                    name="location"
                    class="w-full"
                    required
                    value="{{ old('location', $event->location) }}" />

      {{-- Description --}}
      <x-input-label for="description" value="Description" />
      <textarea id="description"
                name="description"
                rows="4"
                class="w-full rounded border-gray-300">{{ old('description', $event->description) }}</textarea>

      {{-- Cover Image --}}
      <x-input-label for="cover_image" value="Cover Image" />
      <input id="cover_image"
             name="cover_image"
             type="file"
             accept="image/*"
             class="block w-full rounded border-gray-300" />

      @if($event->cover_image)
        <div class="mt-2">
          <p class="text-sm text-gray-600 mb-1">Current image:</p>
          <img src="{{ asset('storage/'.$event->cover_image) }}"
               alt="Current cover image"
               class="max-w-sm rounded">
        </div>
      @endif

      <div class="mt-4 flex gap-2">
        <x-primary-button>Update Event</x-primary-button>
        <a href="{{ route('coach.events.index') }}"
           class="px-4 py-2 rounded border border-gray-300 text-sm">
          Cancel
        </a>
      </div>
    </form>
  </div>
</x-app-layout>
