$(document).ready(function() {

$('#example2').DataTable();

consultar_producto();

})





function consultar_producto(){
   
    axios.get('api/productos').then(res=>{
        let table= $('#example2').DataTable();
        table.clear().draw();
       for(producto of res.data){
           table.row.add(['<img src="/storage/'+producto.imagen+'" style="width: 30px">',producto.name,producto.descripcion,producto.estado,producto.nombre,
           '<a href="javascript:;" clas="btn btn-sm btn-clean btn-icon"  onClick="eliminar('+producto.id+')">Eliminar</a>']).draw();
       }
    })
}

function eliminar(id){
    Swal.fire({
        title: 'Estas seguro de eliminar este producto?',
        text: "Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'NO'
      }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`productos/${id}`).then((res)=>{
                Swal.fire(
                    'Hecho!',
                    'El producto ha sido eliminado.',
                    'success'
                  )
                consultar_producto();
            },(err)=>{
                alert('Ocurrio un error')
            });
        }
      })



    
   
}