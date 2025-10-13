<x-app-layout>
  <div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-primary mb-4">Edit Event</h1>

    <form method="POST" action="{{ route('coach.events.update',$event) }}" class="space-y-4" enctype="multipart/form-data">
  @csrf @method('PUT')
  <!-- existing fields... -->

  <x-input-label for="cover_image" value="Cover Image (optional)" />
  <input id="cover_image" name="cover_image" type="file" accept="image/*"
         class="block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer" />

  @if($event->cover_image)
    <div class="mt-2">
      <p class="text-sm text-gray-600">Current image:</p>
      <img src="{{ asset('storage/'.$event->cover_image) }}" alt="Cover image" class="mt-1 max-w-sm rounded">
    </div>
  @endif

  <x-primary-button class="mt-4">Update</x-primary-button>
</form>

  </div>
</x-app-layout>
