$('.edit-comment').hide();
$('.border-bottom').last().removeClass('border-bottom');


//Add comment through ajax
$('.add-comment-btn').click(function (e) {
    e.preventDefault();

    $.ajax({
       url:'./includes/addComment.php',
       type: "POST",
       data:{
           "add_comment": $('#add_comment').val(),
           "post_id": $('#post_id').val()
       },
        dataType: 'json',
        success: function (data) {
            alert(data.msg);
            $('#output').prepend(data.data);
            $('#add_comment').val('');
            editComment();
            // deleteComment();
        }
    });
});





//Edit comment
function editComment() {
    $('.edit').click(function (e) {
        e.preventDefault();

         let linkId=$(this).attr('href');
         let slicedId=linkId.slice(14);


        //Hide addComment Form and show editComment Form
        $('.add-comment').hide();
        $('.edit-comment').show();
        location.href = "#edit-comment";


        $.ajax({
           url: './includes/post_ajax.php',
           type: "POST",
           data: {
               "id": slicedId
           },
           dataType: 'json',
           success: function (data) {
               $('#update_comment').val(data.comment_content);
               $('#comment_update_id').val(data.comment_id);
           },
           error: function (data) {
                console.log(data);
           }
        });


    });
}

editComment();



$('.close').click(function (e) {
    e.preventDefault();
    $('.edit-comment').hide();
    $('.add-comment').show();
});






//Edit comment throgh ajax
$('.edit-comment-btn').click(function (e) {
    e.preventDefault();

    $.ajax({
        url: './includes/updateComment.php',
        type: "POST",
        data: {
            "update_comment": $('#update_comment').val(),
            "comment_id": $('#comment_update_id').val()
        },
        dataType: 'json',
        success: function (data) {
            $('#comment-'+data.comment_id+' .lead').text(data.comment_content);
            $('#comment-'+data.comment_id+' small').text(data.comment_date);
            location.href = '#comment-'+data.comment_id;

            let msg=$('<div class="bg-success">Comment was successfully updated</div>');
            // msg.innerHTML='';
            $('#comment-'+data.comment_id).append(msg);
            msg.hide();
            msg.fadeIn('slow');
            setTimeout(function () {
                msg.fadeOut('slow');
            },3000);

            $('.edit-comment').hide();
            $('.add-comment').show();

        },
        error: function (data) {
            console.log(data);
        }
    });
});



//Delete comment through ajax
function deleteComment() {
    $('.delete').click(function (e) {
        e.preventDefault();

        let linkId = $(this).attr('href');
        let slicedId = linkId.slice(14);

        let confirmDelete = confirm('Are you sure?');
        if (confirmDelete) {
            $.ajax({
                url: './includes/deleteComment.php',
                type: 'POST',
                data: {
                    "id": slicedId
                },
                success: function (id) {
                    $('.comment-' + id).fadeOut(300);
                }
            });
        }

    });
}

deleteComment();