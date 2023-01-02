<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <section>
                        <div class="container py-5">

                            <header class="text-center mb-5 text-white">
                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <h1>Productos</h1>
                                        <h3>stock</h3>
                                    </div>
                                </div>
                            </header>

                            <div class="row text-center align-items-end">
                                {{-- <div class="col-lg-4 mb-5 mb-lg-0">
                                    <div class="bg-white p-5 rounded-lg shadow">
                                        <h1 class="h6 text-uppercase font-weight-bold mb-4">FREE</h1>
                                        <h2 class="h1 font-weight-bold">$0<span
                                                class="text-small font-weight-normal ml-2">/ free</span></h2>

                                        <div class="custom-separator my-4 mx-auto bg-primary"></div>

                                        <ul class="list-unstyled my-5 text-small text-left">
                                            <li class="mb-3">
                                                <i class="fa fa-check mr-2 text-primary"></i> Lorem ipsum dolor sit amet
                                            </li>
                                            <li class="mb-3">
                                                <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
                                            </li>
                                            <li class="mb-3">
                                                <i class="fa fa-check mr-2 text-primary"></i> At vero eos et accusamus
                                            </li>
                                            <li class="mb-3 text-muted">
                                                <i class="fa fa-times mr-2"></i>
                                                <del>Nam libero tempore</del>
                                            </li>
                                            <li class="mb-3 text-muted">
                                                <i class="fa fa-times mr-2"></i>
                                                <del>Sed ut perspiciatis</del>
                                            </li>
                                            <li class="mb-3 text-muted">
                                                <i class="fa fa-times mr-2"></i>
                                                <del>Sed ut perspiciatis</del>
                                            </li>
                                        </ul>
                                        <a href="#" class="btn btn-primary btn-block shadow rounded-pill">Buy
                                            Now</a>
                                    </div>
                                </div> --}}

                                <a href="{{ route('vistacrearplan') }}" class="btn bg-sky-500 px-3 py-2 rounded-lg  text-white btn-block shadow rounded-pill">Create</a>

                                <table>
                                    <thead>
                                        <tr>
                                            <td>Nombre</td>
                                            <td>Slug</td>
                                            <td>Precio</td>
                                            <td>Descripción</td>
                                            <td>Acciones</td>
                                        </tr>
                                    </thead>
                                    @foreach ($plans as $plan)
                                    <tr>
                                        <th>{{$plan->name}}</th>
                                        <th>{{$plan->slug}}</th>
                                        <th>{{$plan->price}}</th>
                                        <th>{{$plan->description}}</th>
                                        <th>
                                            <a href="{{ route('adminplans.edit', $plan->id) }}" class="btn bg-sky-500 px-3 py-2 rounded-lg  text-white btn-block shadow rounded-pill">Edit</a>
                                            <form action="{{ route('adminplans.delete', $plan->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn bg-sky-500 px-3 py-2 rounded-lg  text-white btn-block shadow rounded-pill">Eliminar</button>
                                            </form>

                                        </th>
                                    </tr>
                                    @endforeach
                                </table>

                                @foreach ($plans as $plan)
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <div class="bg-white p-5 rounded-lg shadow">
                                        <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $plan->name }}</h1>
                                        <h2 class="h1 font-weight-bold">${{ $plan->price }}<span class="text-small font-weight-normal ml-2">soles</span></h2>

                                        <div class="custom-separator my-4 mx-auto bg-primary"></div>
                                        {{--
                                            <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
                                                <li class="mb-3">
                                                    <i class="fa fa-check mr-2 text-primary"></i> Lorem ipsum dolor sit
                                                    amet
                                                </li>
                                                <li class="mb-3">
                                                    <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
                                                </li>
                                                <li class="mb-3">
                                                    <i class="fa fa-check mr-2 text-primary"></i> At vero eos et
                                                    accusamus
                                                </li>
                                                <li class="mb-3">
                                                    <i class="fa fa-check mr-2 text-primary"></i> Nam libero tempore
                                                </li>
                                                <li class="mb-3">
                                                    <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
                                                </li>
                                                <li class="mb-3 text-muted">
                                                    <i class="fa fa-times mr-2"></i>
                                                    <del>Sed ut perspiciatis</del>
                                                </li>
                                            </ul> --}}
                                        <a href="{{ route('plans.show', $plan->slug) }}" class="btn bg-sky-500 px-3 py-2 rounded-lg  text-white btn-block shadow rounded-pill">Comprar</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>