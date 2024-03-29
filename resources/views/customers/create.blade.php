<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24"
  >
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-5">
        Create a Customer
      </h2>
    </header>

    <form method="POST" action="/customer" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <label
          for="name"
          class="inline-block text-lg mb-2"
          >Name</label
        >
        <input
          type="text"
          class="border border-gray-200 rounded p-2 w-full"
          id="name"
          name="name"
          value="{{ old('name') }}"
        />
        @error('name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <button
          class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
        >
          Create
        </button>

        <a href="/customers" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>