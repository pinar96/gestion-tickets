@extends('adminlte::page')

@section('title', 'Mis Tickets')

@section('content_header')
    <h1>Mis Tickets</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('tickets.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Crear ticket</a>
        </div>

        <div class="card-body">
            <table id="ticketsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->status->name }}</td>
                            <td>
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                <form action="{{ route('tickets.destroy', $ticket) }}" id="deleteForm" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-ticket" onclick="deleteTicket({{$ticket->id}})"><i class="fa fa-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/tickets.js"></script>

    <script>
        //incializar DataTable sin utilizar AJAX
        $(document).ready(function() {
            $('#ticketsTable').DataTable();
        });
    </script>

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