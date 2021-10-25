 // delete article
 $(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:'/delArticle/' + id,
                type: 'GET',
                processData: false,
                contentType: false,
                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Post deleted successfully.',
                    }).then((result)=>{
                        if(result.isConfirmed){
                            window.location.reload();
                        }
                    });
                },
                error: function (data, textStatus, xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Not Found',
                        text: 'Sorry we were unable to found this record',
                    });
                },
            });
        }
    });
});




//edit announce
$(document).on('click','.update',function(e){
    e.preventDefault();
    var id = $(this).attr('id');


    $.ajax({
        url:'/getArticle/' + id,
        type: 'GET',
        processData: false,
        contentType: false,
        success:function(data)
        {
            
            $('#article_id').val(data.id);
            
            $('#edit_name').val(data.name);
            $('#edit_name_bangla').val(data.name_bangla);
            $('#edit_description').val(data.description);
            $('#editArticleModal').modal('show');
        },
        error: function(data, textStatus, xhr)
        {
            Swal.fire({
                icon: 'error',
                title: 'Not Found',
                text: 'Sorry We Are Unable To Find This Record.',
            });
        },
});
});

//update announce
$('#editArticle').submit(function(e){
    e.preventDefault();
    var form = $('#editArticle')[0];
    var formData = new FormData(form);

    $.ajax({
        url:'/updateArticle',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success:function(data)
        {
            onSuccessEditRemoveErrors();
            $('#editArticleModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Article updated successfully.',
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.reload();
                }
            });
    
        },
        error: function(reject)
        {
            if (reject.status == 422){

                refreshEditErrors();
                var errors = $.parseJSON(reject.responseText);

                    
                    $.each(errors.errors, function (key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '_help').text(value[0]);
                        })
            }
            
        },
    });
});





//add announce functions
function onSuccessRemoveErrors() {

    $('#title').removeClass('is-invalid');
    $('#title').val('');
    $('#title_help').text('');
    $('#description').removeClass('is-invalid');
    $('#description').val('');
    $('#description_help').text('');
    $('#image').removeClass('is-invalid');
    $('#image').val('');
    $('#image_help').text('');
    

}

function refreshErrors() {
    
    $('#title').removeClass('is-invalid');
    $('#title_help').text('');
    $('#description').removeClass('is-invalid');
    $('#description_help').text('');
    $('#image').removeClass('is-invalid');
    $('#image_help').text('');

}
$('#addArticleModal').on('hidden.bs.modal', function () {
    onSuccessRemoveErrors();
});


//update announce functions

function onSuccessEditRemoveErrors() {
   
    $('#edit_title').removeClass('is-invalid');
    $('#edit_title').val('');
    $('#edit_title_help').text('');
    $('#edit_description').removeClass('is-invalid');
    $('#edit_description').val('');
    $('#edit_description_help').text('');
    

}

function refreshEditErrors() {
    $('#edit_title').removeClass('is-invalid');
    $('#edit_title_help').text('');
    $('#edit_description').removeClass('is-invalid');
    $('#edit_description_help').text('');

}
$('#editArticleModal').on('hidden.bs.modal', function () {
    onSuccessEditRemoveErrors();
});

 //remove errors from input fields
 $('input#title').focus(function(){
    $('input#title').removeClass('is-invalid');
    $('#title_help').text('');
});
 $('textarea#description').focus(function(){
    $('textarea#description').removeClass('is-invalid');
    $('#description_help').text('');
});

$('input#image').focus(function(){
    $('input#image').removeClass('is-invalid');
    $('#image_help').text('');
});

$('input#edit_title').focus(function(){
    $('input#edit_title').removeClass('is-invalid');
    $('#edit_title_help').text('');
});
 $('textarea#edit_description').focus(function(){
    $('textarea#edit_description').removeClass('is-invalid');
    $('#edit_description_help').text('');
});

$('input#name').focus(function(){
    $('#name_help').text('');
});
$('input#email').focus(function(){
    $('#email_help').text('');
});
$('input#password').focus(function(){
    $('#password_help').text('');
});
$('input#password_confirmation').focus(function(){
    $('#password_confirmation_help').text('');
});
