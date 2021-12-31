$(document).ready(function() {
    
    $('#formCrear').on('submit', function(e){
        e.preventDefault();
        let formCrear = $(this)[0];
        let data = new FormData(formCrear);
        
        axios.post(formCrear.action, data).then(res => {
            formCrear.reset();
            Swal.fire(res.data.msj)
        }, (err) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Todos los campos son obligatoorios!'
              })
        });
    });
    
    })