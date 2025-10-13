<x-app-layout>
  <div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-primary mb-4">Create Event</h1>

   <form method="POST" action="{{ route('coach.events.store') }}" class="space-y-4" enctype="multipart/form-data">
  @csrf

  <x-input-label for="title" value="Title" />
  <x-text-input id="title" name="title" class="w-full" required />

  <x-input-label for="sport_type" value="Sport Type" />
  <x-text-input id="sport_type" name="sport_type" class="w-full" required placeholder="Football, Chess..." />

  <x-input-label for="starts_at" value="Starts At" />
  <x-text-input id="starts_at" name="starts_at" type="datetime-local" class="w-full" required />

  <x-input-label for="ends_at" value="Ends At (optional)" />
  <x-text-input id="ends_at" name="ends_at" type="datetime-local" class="w-full" />

  <x-input-label for="location" value="Location" />
  <x-text-input id="location" name="location" class="w-full" required />

  <x-input-label for="description" value="Description" />
  <textarea id="description" name="description" class="w-full rounded border-gray-300"></textarea>

  <!-- ✅ Cover Image -->
  <x-input-label for="cover_image" value="Cover Image (optional)" />
  <input id="cover_image" name="cover_image" type="file" accept="image/*"
         class="block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer" />

  <x-primary-button class="mt-4">Save</x-primary-button>
</form>

  </div>
</x-app-layout>
