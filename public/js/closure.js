$(document).ready(function() {
    $('a[href="#"]').on('click',function(event){
        event.preventDefault();

        $.ajax({
            url: '/unavailable',
            success:
                function(response){
                    $('#modal-common .modal-content').html(response);
                    $('#modal-common').modal('show');
                }
        });
    });
});