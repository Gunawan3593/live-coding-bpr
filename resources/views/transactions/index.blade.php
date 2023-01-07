<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Transactions History
            </h1>
        </header>
        <div class="flex flex-col">
            <div class="flex flex-col lg:flex-row">
                <div class="mb-6 lg:mr-5">
                    <label
                    for="customer"
                    class="inline-block text-lg mb-2"
                    >Customer From</label
                    >
                    <select class="border border-gray-200 rounded p-2 w-full" id="customer"
                    name="customer">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"> {{ $customer->name }} </option>
                    @endforeach
                    </select>
                </div>
                <div class="mb-6 lg:mr-5">
                    <label
                    for="account"
                    class="inline-block text-lg mb-2"
                    >Account</label
                    >
                    <select class="border border-gray-200 rounded p-2 w-full" id="account"
                    name="account">
                    <option value="">Select Account</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-auto">
                        <table class="table-auto lg:table-fixed w-full">
                            <thead class="bg-white border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 text-left lg:w-52">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 text-left">
                                        Notes
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 text-left">
                                        Nominal
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 text-left">
                                        Balance
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="rows">    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
    <script>
    $(document).ready(function () {
      norows = `
        <tr class="border-gray-300">
            <td colspan="4" class="px-3 py-2 border-t border-b border-gray-300">
            <p class="text-center">No Transactions found.</p>
            </td>
        </tr>  
        `;
      $('#rows').html(norows);
      $(document).on('change', '#customer', function() {
        setAccountList('#account', $(this).val());
        $('#rows').html(norows);
      });

      $(document).on('change', '#account', function() {
        getDataTransactions('#rows', $(this).val());
      });

      function setAccountList(id, selected) 
      {
        var op = " ";
        $.ajax({
            type: 'get',
            url: "{!!URL::to('bank-account/by-customer')!!}",
            data: {'customer_id': selected},
            success: function(data){
                op = '<option value="">Select Account</option>';
                for (var i = 0; i < data.length; i++){
                    op += '<option value="'+data[i].id+'">'+data[i].account_number+'</option>';
                }
                $(id).html(" ");
                $(id).append(op);
            },
            error: function(){
                console.log('success');
            },
        });
      }

      function getDataTransactions(id, account) {
        var rows = " ";
        $.ajax({
            type: 'get',
            url: "{!!URL::to('transaction/by-account')!!}",
            data: {'account_id': account},
            success: function(data){
                balance = 0;
                if(data.length > 0) {
                    for (var i = 0; i < data.length; i++){
                        balance += data[i].nominal;
                        rows += `
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">${ i+1 }</td>
                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">${ data[i].type }</td>
                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">${ data[i].nominal }</td>
                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">${ balance }</td>
                        </tr>
                        `;
                    }
                } else {
                    rows = norows;
                }
                $(id).html(" ");
                $(id).append(rows);
            },
            error: function(){
                console.log('success');
            },
        });
      }
    });
  </script>
</x-layout>
