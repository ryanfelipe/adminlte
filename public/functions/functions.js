$(document).ready(()=>{
    $('#editarUsuario').on('click',function(){
        var user = $(this).data('user');
        

        $('.modal-title').text(user.name);

        var permissoes = $('#permissoes').data('permissoes').split(',');

        //Combobox
        options = '';
        $.each(permissoes, function(i,item){
            options +="<option value='"+item+"'";
            if(user.permission == item){
                options +='selected';
            }
            options +='>';
            options +=item +"</option>";            
        });
        $('#user_p').empty();
        $('#user_p').append(options);
    });
});