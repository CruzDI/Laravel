<style>
        .institution {
            text-align: center; /* Centra el contenido horizontalmente */
        }
        .institution .fa {
            color: green; 
        }
    </style>
@extends('master')

@section('titulo', 'Listado de Productos')

@section('contenido')
<div class="container text-center">
    <h1>Listado de Productos</h1>
    <hr>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <h1>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Agregar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>${{number_format($producto->precio,0)}}</td>
                <td>{{ $producto->cantidad }}</td>
                <td>
                    <a href="{{route('carrito-agregar', $producto->id) }}">
                    <div class="institution">
        <i class="fa fa-shopping-cart fa-2x"></i>
        <!-- Otros íconos o contenido dentro del contenedor 'institution' -->
    </div>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</div>
@endsection
