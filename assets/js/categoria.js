function ordenarProductos(categoria) {
    const orden = document.getElementById('filtroOrden').value;
    const url = orden ? `/MICHICOLECCION/categoria/${categoria}/pagina/1/ordenar/${orden}` : `/MICHICOLECCION/categoria/${categoria}/pagina/1`;
    window.location.href = url;
}