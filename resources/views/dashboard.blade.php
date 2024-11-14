@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h2>Bienvenid@ {{auth()->user()->name}} </h2>
                    @if (auth()->user()->role === 'admin')
                    <p>Seleccione una de las opciones del menú superior</p>
                    @else
                    <h3>Mis Reservas</h3>
                    @include('reservas.list')
                    @endif
                </div>

            </div>
        </div>
    </div>
    @endsection