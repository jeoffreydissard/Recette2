$('.dropdown-trigger').dropdown({
    alignment: 'right',
    constrainWidth: false,
    coverTrigger: false,
    hover: true
});

$('.dropdown-trigger2').dropdown({
    alignment: 'left',
    constrainWidth: false,
    coverTrigger: false,
    hover: true
});

$('#CreerSalon').hide();
$('#Chatbot').hide();

$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.modal').modal();
    $('.carousel').carousel({
        numVisible: 3,
        fullWidth: false,
        indicators: false,
        noWrap: false
    });
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: false
    });
    $('#btn-Creer').click(function () {
            $('#RejoindreSalon').hide();
            $('#CreerSalon').toggle();
    });
    $('#btn-Rejoindre').click(function () {
        $('#CreerSalon').hide();
        $('#RejoindreSalon').toggle();
    });

    $('.fixed-action-btn').floatingActionButton({
        hoverEnabled: false
    });

    $('#Btn-Chatbot').click(function () {
        $('#Btn-Chatbot').hide();
        $('#Chatbot').toggle();
    });
    $('#Btn-Close-Chatbot').click(function () {
        $('#Btn-Chatbot').show();
        $('#Chatbot').toggle();
    });


    $('#card1').height()

});
