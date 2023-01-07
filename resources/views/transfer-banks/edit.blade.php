<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24"
  >
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-5">
        Edit a Transfer Bank
      </h2>
    </header>

    <form method="POST" action="/transfer-bank/{{ $transfer_bank->id }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <label
          for="customer_from"
          class="inline-block text-lg mb-2"
          >Customer From</label
        >
        <select class="border border-gray-200 rounded p-2 w-full" id="customer_from"
          name="customer_from">
          <option value="">Select Customer From</option>
          @foreach ($customers as $customer)
            <option value="{{ $customer->id }}" {{ ( $customer->id == $transfer_bank->customer_from) ? 'selected' : '' }}> {{ $customer->name }} </option>
          @endforeach
        </select>
        @error('customer_from')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label
          for="account_from"
          class="inline-block text-lg mb-2"
          >Account From</label
        >
        <select class="border border-gray-200 rounded p-2 w-full" id="account_from"
          name="account_from">
          <option value="">Select Account</option>
        </select>
        @error('account_from')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label
          for="customer_to"
          class="inline-block text-lg mb-2"
          >Customer To</label
        >
        <select class="border border-gray-200 rounded p-2 w-full" id="customer_to"
          name="customer_to">
          <option value="">Select Customer To</option>
          @foreach ($customers as $customer)
            <option value="{{ $customer->id }}" {{ ( $customer->id == $transfer_bank->customer_to) ? 'selected' : '' }}> {{ $customer->name }} </option>
          @endforeach
        </select>
        @error('customer_to')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label
          for="account_from"
          class="inline-block text-lg mb-2"
          >Account To</label
        >
        <select class="border border-gray-200 rounded p-2 w-full" id="account_to"
          name="account_to">
          <option value="">Select Account</option>
        </select>
        @error('account_to')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label
          for="nominal"
          class="inline-block text-lg mb-2"
          >Nominal</label
        >
        <input
          type="text"
          class="border border-gray-200 rounded p-2 w-full"
          id="nominal"
          name="nominal"
          value="{{ $transfer_bank->nominal }}"
        />
        @error('nominal')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <button
          class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
        >
          Update
        </button>

        <a href="/customers" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
  <script>
    $(document).ready(function () {
      customer_from = $('#customer_from').val();
      account_from = '<?php echo $transfer_bank->account_from; ?>';
      setAccountList('#account_from', customer_from, account_from);
      customer_to = $('#customer_to').val();
      account_to = '<?php echo $transfer_bank->account_to; ?>';
      setAccountList('#account_to', customer_to, account_to);
      $(document).on('change', '#customer_from', function() {
        setAccountList('#account_from', $(this).val())
      });

      $(document).on('change', '#customer_to', function() {
        setAccountList('#account_to', $(this).val())
      });

      function setAccountList(id, selected, cur_val) 
      {
        var op = " ";
        $.ajax({
            type: 'get',
            url: "{!!URL::to('bank-account/by-customer')!!}",
            data: {'customer_id': selected},
            success: function(data){
                op = '<option value="">Select Account</option>';
                for (var i = 0; i < data.length; i++){
                    op += '<option value="'+data[i].id+'"'+ ((data[i].id == cur_val) ? 'selected' : '') +'>'+data[i].account_number+'</option>';
                }
                $(id).html(" ");
                $(id).append(op);
            },
            error: function(){
                console.log('success');
            },
        });
      }
    });
  </script>
</x-layout>