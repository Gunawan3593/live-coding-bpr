<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage Customers
            </h1>
        </header>

        <div class="flex flex-col">
            <a
                href="/customer/create"
                class="text-blue-400 px-3 py-2 text-center lg:text-left"
            >
                <i
                    class="fa-solid fa-plus"
                ></i>
                New Customer
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
                                        Name
                                    </th>
                                    <th scope="col" colspan="2" class="text-sm text-center font-medium text-gray-900 px-3 py-2 lg:w-1/4">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @unless ($customers->isEmpty())
                                    @php $i = 0 @endphp
                                    @foreach ($customers as $customer)
                                        @php $i++ @endphp
                                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i }}</td>
                                            <td class="text-sm text-gray-900 font-light px-3 py-2 whitespace-nowrap">
                                                {{ $customer->name }}
                                            </td>
                                            <td
                                                class="px-3 py-2 border-t border-b border-gray-300"
                                            >
                                                <a
                                                href="/customer/{{ $customer->id }}/edit"
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
                                                <form method="POST" action="/customer/{{ $customer->id }}">
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
                                        <td colspan="4" class="px-3 py-2 border-t border-b border-gray-300">
                                        <p class="text-center">No Customers found.</p>
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
