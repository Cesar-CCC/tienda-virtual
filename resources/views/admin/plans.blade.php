<x-app-layout>
    <x-slot name="header">

        <div class="flex ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M6 3a3 3 0 00-3 3v2.25a3 3 0 003 3h2.25a3 3 0 003-3V6a3 3 0 00-3-3H6zM15.75 3a3 3 0 00-3 3v2.25a3 3 0 003 3H18a3 3 0 003-3V6a3 3 0 00-3-3h-2.25zM6 12.75a3 3 0 00-3 3V18a3 3 0 003 3h2.25a3 3 0 003-3v-2.25a3 3 0 00-3-3H6zM17.625 13.5a.75.75 0 00-1.5 0v2.625H13.5a.75.75 0 000 1.5h2.625v2.625a.75.75 0 001.5 0v-2.625h2.625a.75.75 0 000-1.5h-2.625V13.5z" />
              </svg>

        <h2 class="font-semibold text-md text-gray-800 leading-tight px-2 py-1">
            {{ __('Administración de productos') }}
        </h2></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-end py-2">
                    <a href="{{ route('vistacrearplan') }}" class="btn bg-sky-500 px-3 py-1 rounded-lg  text-white btn-block shadow rounded-pill text-sm">Añadir Producto</a>
                </div>
                <table class="table-fixed ">
                    <thead>
                        <tr
                            class=" text-xs font-semibold tracking-wide text-left text-zinc-600 uppercase border-b dark:border-zinc-700 bg-white dark:text-zinc-400 dark:bg-zinc-900">
                            <th class="px-2 py-2 ">N°</th>
                            <th class="px-2 py-2 w-1/3 text-center">NOMBRE</th>
                            <th class="px-2 py-2 w-1/5 text-center">SLUG</th>
                            <th class="px-2 py-2 w-1/6 text-center">PRECIO</th>
                            <th class="px-2 py-2 w-1/6 text-center">DESCRIPCION</th>
                            <th class="px-2 py-2 w-1/6 text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:divide-zinc-700 dark:bg-zinc-900">
                         @php $i=1; @endphp
                         @foreach ($plans as $plan)
                        <tr class="text-zinc-700 dark:text-zinc-400">
                            <td class="px-2 py-2 text-xs">
                                @php echo $i; @endphp
                            </td>
                            <td class="px-2 py-2 text-xs">
                                {{$plan->name}}
                            </td>
                            <td class="px-2 py-2 text-xs">
                                {{$plan->slug}}
                            </td>
                            <td class="px-2 py-2 text-xs">
                                {{$plan->price}}
                            </td>
                            <td class="px-3 py-3 text-xs text-center">
                                {{$plan->description}}
                            <td class="px-3 py-3 flex justify-center">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('adminplans.edit', $plan->id) }}"
                                        class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 bg-yellow-500  text-white rounded-lg  focus:outline-none focus:shadow-outline-zinc"
                                        aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('adminplans.delete', $plan->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 bg-orange-500 text-white rounded-lg  focus:outline-none focus:shadow-outline-zinc">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                              </svg>
                                           </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @php $i++; @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
