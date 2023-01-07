<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage Transfer Banks
            </h1>
        </header>

        <div class="flex flex-col">
            <a
                href="/transfer-bank/create"
                class="text-blue-400 px-3 py-2 text-center lg:text-left"
            >
                <i
                    class="fa-solid fa-plus"
                ></i>
                New Transfer
            </a>
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
                                        Transfer from 
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 text-left">
                                        Transfer to
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 text-left">
                                        Nominal
                                    </th>
                                    <th scope="col" colspan="2" class="text-sm text-center font-medium text-gray-900 px-3 py-2 lg:w-1/4">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @unless ($transfer_banks->isEmpty())
                                    @php $i = 0 @endphp
                                    @foreach ($transfer_banks as $transfer_bank)
                                        @php $i++ @endphp
                                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i }}</td>
                                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">
                                                {{ $transfer_bank->customer_from_dtl->name .' - '. $transfer_bank->account_from_dtl->account_number .' ('.$transfer_bank->account_from_dtl->bank_name.')' }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">
                                            {{ $transfer_bank->customer_to_dtl->name .' - '. $transfer_bank->account_to_dtl->account_number .' ('.$transfer_bank->account_to_dtl->bank_name.')' }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">
                                                {{ $transfer_bank->nominal }}
                                            </td>
                                            <td
                                                class="px-3 py-2 border-t border-b border-gray-300"
                                            >
                                                <a
                                                href="/transfer-bank/{{ $transfer_bank->id }}/edit"
                                                class="text-blue-400 px-3 py-2 rounded-xl"
                                                ><i
                                                    class="fa-solid fa-pen-to-square"
                                                ></i>
                                                Edit</a
                                                >
                                            </td>
                                            <td
                                                class="px-3 py-2 border-t border-b border-gray-300"
                                            >
                                                <form method="POST" action="/transfer-bank/{{ $transfer_bank->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600">
                                                    <i
                                                    class="fa-solid fa-trash-can"
                                                    ></i>
                                                    Delete
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="border-gray-300">
                                        <td colspan="6" class="px-3 py-2 border-t border-b border-gray-300">
                                        <p class="text-center">No Transfer Banks  found.</p>
                                        </td>
                                    </tr>    
                                @endunless
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
</x-layout>
