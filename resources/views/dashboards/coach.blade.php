<x-app-layout>
  <div class="p-6">
    <h1 class="text-2xl font-bold text-primary">Coach Dashboard</h1>
    <p class="mt-2">Create events and view player availability.</p>

    <div class="mt-6">
      <a href="{{ route('coach.events.index') }}"
         class="inline-flex items-center px-4 py-2 rounded bg-primary text-white hover:bg-accent2">
        Manage My Events
      </a>
      <a href="{{ route('coach.events.create') }}"
         class="ml-3 inline-flex items-center px-4 py-2 rounded bg-gray-900 text-white hover:bg-gray-700">
        + New Event
      </a>
      <a href="{{ route('coach.profile.edit') }}"
   class="ml-3 inline-flex items-center px-4 py-2 rounded ring-1 ring-primary text-primary hover:bg-secondary">
  Edit Coach Profile
</a>

    </div>
  </div>
</x-app-layout>
