<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24"
  >
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-5">
        Create a bank Account
      </h2>
    </header>

    <form method="POST" action="/bank-account" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <label
          for="customer"
          class="inline-block text-lg mb-2"
          >Customer Name</label
        >
        <select class="border border-gray-200 rounded p-2 w-full" id="customer"
          name="customer">
          <option value="">Select Customer</option>
          @foreach ($customers as $customer)
            <option value="{{ $customer->id }}" {{ ( $customer->id == old('customer')) ? 'selected' : '' }}> {{ $customer->name }} </option>
          @endforeach
        </select>
        @error('customer')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label
          for="bank_name"
          class="inline-block text-lg mb-2"
          >Bank Name</label
        >
        <input
          type="text"
          class="border border-gray-200 rounded p-2 w-full"
          id="bank_name"
          name="bank_name"
          value="{{ old('bank_name') }}"
        />
        @error('bank_name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label
          for="account_number"
          class="inline-block text-lg mb-2"
          >Account Number</label
        >
        <input
          type="text"
          class="border border-gray-200 rounded p-2 w-full"
          id="account_number"
          name="account_number"
          value="{{ old('account_number') }}"
        />
        @error('account_number')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <button
          class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
        >
          Create
        </button>

        <a href="/bank-accounts" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>