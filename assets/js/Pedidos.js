document.getElementById('estadoVenta').addEventListener('change', function() {
    var idPedido = this.getAttribute('data-id');
    var idEstatusVenta = this.value;
    var formData = new FormData();
    formData.append('idPedido', idPedido);
    formData.append('idEstatusVenta', idEstatusVenta);

    fetch('/MICHICOLECCION/admin/orden/actualizarEstado', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => console.error('Error:', error));
});