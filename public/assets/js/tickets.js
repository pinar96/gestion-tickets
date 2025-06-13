function deleteTicket(ticketId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Este ticket será eliminado permanentemente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/tickets/'+ticketId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Error al eliminar');
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    title: 'Eliminado',
                    text: data.message,
                    icon: 'success',
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    location.reload();
                }, 1300);
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'No se pudo eliminar el ticket.', 'error');
            });
        }
    });
}