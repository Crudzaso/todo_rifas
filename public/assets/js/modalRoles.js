document.addEventListener('DOMContentLoaded', function () {
    const removePermissionsButtons = document.querySelectorAll('.btn-remove-permissions');

    removePermissionsButtons.forEach(button => {
        button.addEventListener('click', function () {
            const roleId = this.getAttribute('data-role-id');

            // Limpia las opciones anteriores en el modal
            const permissionsSelect = document.getElementById('permissions');
            permissionsSelect.innerHTML = '';

            // Actualiza la acción del formulario con el roleId
            document.getElementById('removePermissionsForm').action = `/admin/roles/${roleId}/remove-permissions`;

            // Realiza la solicitud AJAX para obtener los permisos del rol específico
            fetch(`/admin/roles/${roleId}/permissions`)
                .then(response => response.json())
                .then(data => {
                    data.permissions.forEach(permission => {
                        const option = document.createElement('option');
                        option.value = permission.id;
                        option.textContent = permission.name;
                        permissionsSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar permisos:', error));

            // Muestra el modal
            const removePermissionsModal = new bootstrap.Modal(document.getElementById('removePermissionsModal'));
            removePermissionsModal.show();
        });
    });
});
