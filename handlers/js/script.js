$(document).ready(function() {

    console.log("script loaded");

    /*user verification js*/
    $(".user-list").change(function (){

        let user_id = {
            'user_id' : $(this).children(":selected").attr("id")
        };

        // alert(user_id);
        $.ajax(({
            type:"POST",
            url: "https://dev.ezdev.solutions/handlers/get_id_location.php",
            data: user_id,
            success: function (data){
                $(".user-id-image-container").html("<img style='height: 550px' src='" + data + "' alt='user-id'>")
            }
        })).done(function(data) {
            // alert("success" + data);
        }).fail(function(data) {
            alert("failure" + data);
        })

    });

    /*user verification js*/
    $( ".user-verification-form" ).on( "submit", function(e) {
        console.log("verification form submitted.")
        //e.preventDefault();
        let data_string = $(this).serialize();
        // console.log($(this).serialize()); return false;
        $.ajax({
            type: "POST",
            url: "https://dev.ezdev.solutions/handlers/approve_user.php",
            data: data_string })
            .done(function(data){
                console.log(data);
                $('.approve-user-main-content').html(data);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
        return false;
    });




    /*election admin js*/
    $( ".election-form" ).on( "submit", function(e) {
        console.log("election form submitted.")
        let data_string = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "https://dev.ezdev.solutions/handlers/election_form_handler.php",
            data: data_string })
            .done(function(data){
                console.log(data);
                $('#message').html(data);
            })
            .fail(function() { // i
                alert( "Posting failed." );
            });
        return false;
    });


    /*party admin js*/
    $("#party-list").change(function (){

        let party_name = {
            'party_name' : $(this).children(":selected").attr("id")
        };

        // alert(user_id);

        $.ajax(({
            type:"POST",
            url: "https://dev.ezdev.solutions/handlers/party_loader.php",
            data: party_name,
            success: function (data){
                $(".governing-party-admin-container-left").html(data)
            }
        })).done(function(data) {
            // alert("success" + data);
        }).fail(function(data) {
            alert("failure" + data);
        })

    });


    /*election admin js*/
    $( ".party-admin-form" ).on( "submit", function(e) {
        console.log("party form submitted.")
        e.preventDefault();
        let data_string = $(this).serialize();
        // console.log($(this).serialize()); return false;
        $.ajax({
            type: "POST",
            url: "https://dev.ezdev.solutions/handlers/governing_party_handler.php",
            data: data_string })
            .done(function(data){
                console.log(data);
                $('.governing-party-admin-container-left').html(data);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
        return false;
    });


function check_id(){

    let id = {
        'id' : $('#id-number').val()
    };

    $.ajax(({
        type:"POST",
        url: "https://dev.ezdev.solutions/handlers/check_if_registered.php",
        data: id,
        success: function (data){
            if (!(data == '')){
                alert(data);
                $('#id-number').val('');
            }
        }
    })).done(function(data) {
        // alert("success" + data);
    }).fail(function(data) {
        // alert("failure" + data);
    })


}
    /*Register page id validation js*/
    $('#id-number').on('change', function (e){
        check_id();
    });
    $('#id-number').on('load', function (e){
        check_id();
    });
});