@extends('adminlte::page')

@section('title', 'Ver Ticket')

@section('content_header')
    <h1>Detalle del Ticket #{{$ticket->id}}</h1>
@stop

@section('content')
<div class="container">
        <div class="mb-3">
            <label for="subject" class="form-label">Asunto</label>
            <input type="text" name="subject" id="subject" class="form-control" value="{{ $ticket->subject }}" readonly>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Cuerpo</label>
            <textarea name="body" id="body" class="form-control" rows="5" disabled>{{ $ticket->body }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select name="status_id" id="status_id" class="form-select" disabled>
                @foreach($ticketsStatuses as $status)
                    <option value="{{ $status->id }}" {{ $ticket->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">regresar</a>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
@stop