function openEditModal(id, name, description) {
    // Llenar los campos del formulario con los datos de la rifa
    $('#editName').val(name);
    $('#editDescription').val(description);  // Asegúrate de que description es el campo correcto

    // Actualizar la acción del formulario con la URL de actualización
    $('#editForm').attr('action', '/raffles/' + id);

    // Mostrar el modal
    $('#editModal').modal('show');
}
