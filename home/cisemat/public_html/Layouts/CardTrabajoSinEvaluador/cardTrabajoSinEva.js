//Confirma el borrado de archivos
function confirmar(event){
    if (!confirm('¿Realmente desea eliminar el trabajo?')) {
        event.preventDefault();
      }
}