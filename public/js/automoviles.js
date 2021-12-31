var arrayautos=[];
$(document).ready(function() {

   $('#example2').DataTable({columnDefs:[{
      targets: "_all",
      sortable: false
  }],});
   
   consultar_autos();
   consultarDepartamentos();
   

   $('#btnnuevo').click(function(){
      $('#modal-crear').modal('show');
   });
   $('#departamento').select2();
   
   $('#formcrear').submit(function(e){
      e.preventDefault();

      if($('#nombre').val()=='' || $('#modelo').val()=='' || $('#marca').val()==''){
         swal.fire({
            title: 'Gestión de automoviles',
            text: 'Todos los campos son obligatorios',
            icon: 'warning',
            confirmButtonText: 'Aceptar',
         });
         return;
      }
      let form=$(this)[0];
      let data=new FormData(form);
      swal.fire({
         title: 'Guardando...',
      });
      swal.showLoading();
      axios.post(form.action, data).then(res=>{
         
         if (res.data.ErrorStatus) {
            icon = 'error';
         } else {
            $("#formcrear")[0].reset();
            icon = 'success';
            consultar_autos();
            $('#modal-crear').modal('hide');
         }
         
 
         swal.fire({
             title: 'Gestión de automoviles',
             text: res.data.Msj,
             icon: icon,
             confirmButtonText: 'Aceptar',
         });
 
      },(err)=>{
         swal.fire({
             icon:'error',
             title:'Ooops...',
             text:Object.values(err.response.data.errors)[0],
 
         })
 
      });

      
   });

   $('#formeditar').submit(function(e){
      e.preventDefault();

      if($('#nombre_edit').val()=='' || $('#modelo_edit').val()=='' || $('#marca_edit').val()==''){
         swal.fire({
            title: 'Gestión de automoviles',
            text: 'Todos los campos son obligatorios',
            icon: 'warning',
            confirmButtonText: 'Aceptar',
         });
         return;
      }
      let form=$(this)[0];
      let data=new FormData(form);
      swal.fire({
         title: 'Guardando...',
      });
      swal.showLoading();
      axios.post(form.action+'/'+$('#idauto').val(), data).then(res=>{
         
         if (res.data.ErrorStatus) {
            icon = 'error';
         } else {
            $("#formeditar")[0].reset();
            icon = 'success';
            consultar_autos();
            $('#modal-editar').modal('hide');
         }
         
 
         swal.fire({
             title: 'Gestión de automoviles',
             text: res.data.Msj,
             icon: icon,
             confirmButtonText: 'Aceptar',
         });
 
      },(err)=>{
         swal.fire({
             icon:'error',
             title:'Ooops...',
             text:Object.values(err.response.data.errors)[0],
 
         })
 
      });

      
   });
})
   
function consultarDepartamentos(){

   axios.get('https://www.datos.gov.co/resource/xdk5-pm3f.json').then(res=>{

      let selectdpto = $('#departamento');
      let selectdptoedit = $('#departamento_edit');
      let dep='';
      for(item of res.data){
         if(item.departamento!=dep){
            selectdpto.append(`
                     <option value="${item.departamento}">${item.departamento}</option>
            `)
            selectdptoedit.append(`
                     <option value="${item.departamento}">${item.departamento}</option>
            `)
         }
         dep=item.departamento;
      }
     
   })
}
   
function marcar() {
   if($('#checktodo').is( ':checked' )){

      $(".check-item").each(function(){
         
        $( this).prop("checked", true); 
         
      });

   }else{

      $(".check-item").each(function(){
         
         $( this).prop("checked", false); 
          
      });

   }
}
function eliminarmasivo(){
   arryid_id=[];
    $(".check-item").each(function(){
      id=$(this).attr("id");
        
      if( $( this ).is( ':checked' ) ){
         
         arryid_id.push(id);

      }
	})

   if(arryid_id.length>0){
      console.log(arryid_id)
      swal.fire({
         title: 'Elimando...',
      });
      swal.showLoading();
      axios.post(`/automoviles-elimnar-masivo/${arryid_id}`).then(res=>{
         if(!res.data.ErrorStatus){
            icon = 'success';
            consultar_autos();
            $('#checktodo').prop("checked", false); 
         }else{
            icon = 'error';
         }
          
         swal.fire({
            title: 'Gestión de automoviles',
            text: res.data.Msj,
            icon: icon,
            confirmButtonText: 'Aceptar',
         });          
      
      }, err => {
          swal.fire({
                  title: 'Gestión de automoviles',
                  text: 'Error en el servicio de eliminar autos',
                  icon: 'error',
                  confirmButtonText: 'Aceptar'
          });
      });
   }else{
      swal.fire({
         title: 'Gestión de automoviles',
         text: 'No hay autos seleccionadas para eliminar',
         icon: 'warning',
         confirmButtonText: 'Aceptar'
       });
   }
}
   
   function consultar_autos(){
      
         axios.get('api/getAutos').then(res=>{
            arrayautos=res.data;
            let table= $('#example2').DataTable();
            table.clear().draw();
            for(auto of res.data){
               table.row.add([`<input type="checkbox" class="form-check-input check-item" id="${auto.Auto_id}" style="margin-left: 19px;">`,
                  auto.Auto_name,
                  auto.Auto_marca,
                  auto.Auto_modelo,
                  auto.Auto_departamento,
                  `<i class="fas fa-edit ml-3" style="cursor:pointer;" onclick="vistaeditar(${auto.Auto_id})"></i> <i class="fas fa-trash-alt ml-3" style="cursor:pointer;" onclick="eliminar(${auto.Auto_id})"></i>`
               ]).draw();
            }
         })
   }

   function vistaeditar(id){
      let datos = arrayautos.filter(res=>res.Auto_id == id);

      $('#idauto').val(id);
      $('#nombre_edit').val(datos[0].Auto_name);
      $('#modelo_edit').val(datos[0].Auto_modelo);
      $('#marca_edit').val(datos[0].Auto_marca);
      $('#departamento_edit').val(datos[0].Auto_departamento);
      $('#modal-editar').modal('show');

   }
   
   function eliminar(id){
       Swal.fire({
           title: 'Estas seguro de eliminar este automovil?',
           text: "Esta acción no se puede deshacer!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Si, Eliminar!',
           cancelButtonText: 'NO'
         }).then((result) => {
           if (result.isConfirmed) {
               axios.delete(`automoviles/${id}`).then((res)=>{
                   Swal.fire(
                       'Hecho!',
                       'El automovil ha sido eliminado.',
                       'success'
                     )
                     consultar_autos();
               },(err)=>{
                  swal.fire({
                     icon:'error',
                     title:'Ooops...',
                     text:'Ocurrio un error',
         
                  })
               });
           }
         })
   }