(function () {

    let modalDelete = document.getElementById('modalDelete');
    let deleteEmpleadoNombre = document.getElementById('deleteEmpleadoNombre');
    let deleteEmpleadoTelefono = document.getElementById('deleteEmpleadoTelefono');
    modalDelete.addEventListener('show.bs.modal', function (event) {
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let name = element.dataset.name;
        let tel = element.dataset.tel;
        if(deleteEmpleadoNombre && deleteEmpleadoTelefono) {
            deleteEmpleadoNombre.innerHTML = name;
            deleteEmpleadoTelefono.innerHTML = tel;
        }
        let form = document.getElementById('modalDeleteResourceForm');
        form.action = action;
    });

})();