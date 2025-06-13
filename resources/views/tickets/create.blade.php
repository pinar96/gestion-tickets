@extends('adminlte::page')

@section('title', 'Nuevo Ticket')

@section('content_header')
    <h1>Nuevo Ticket</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="subject" class="form-label">Asunto</label>
            <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Cuerpo</label>
            <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select name="status_id" id="status_id" class="form-select" required>
                @foreach($ticketsStatuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>    Guardar Ticket</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Session::has('message'))
        <script>
            Swal.fire({
                position: "center",
                icon: "{{Session::get('alert-type')}}",
                title: "{{Session::get('message')}}",
                showConfirmButton: "{{Session::get('showConfirmButton')}}",
                timer: "{{Session::get('timer')}}"
            });
        </script>
    @endif
@stop