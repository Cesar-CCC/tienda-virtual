<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('adminplans.update', $plan->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $plan->name }}" placeholder="Nombre">
        </div>
        <div>
            <label for="nombre">Slug:</label>
            <input type="text" name="slug" id="slug" value="{{ $plan->slug }}" placeholder="Slug">
        </div>
        <div>
            <label for="nombre">Stripe Plan:</label>
            <input type="text" name="stripe_plan" value="{{ $plan->stripe_plan }}" id="stripe_plan" placeholder="Stripe_Plan">
        </div>
        <div>
            <label for="nombre">Precio:</label>
            <input type="number" name="price" id="price" value="{{ $plan->price }}" placeholder="Precio">
        </div>

        <div>
            <label for="nombre">Descripción:</label>
            <input type="text" name="description" id="description" value="{{ $plan->description }}" placeholder="Precio">
        </div>

        <div>
            <button class="btn btn-light border-dark" type="submit">Actualizar Producto</button>
        </div>
    </form>

</x-app-layout>