window.onload = function(){
    if(location.hash == '#thankyou'){
        alert("Ваше сообщение успешно отправлено!");
        location.hash = '';
    }else if (location.hash == '#error'){
        alert("Произошла ошибка!");
        location.hash = '';
    }
}
$('.nav a[href="#about"]').click(function (event) {
    event.preventDefault();
    $('body,html').animate({scrollTop: $("#about")[0].offsetTop}, "slow");
});
$('.nav a[href="#clients"]').click(function (event) {
    event.preventDefault();
    $('body,html').animate({scrollTop: $("#clients")[0].offsetTop}, "slow");
});
$('.nav a[href="#feedback"]').click(function (event) {
    event.preventDefault();
    $('body,html').animate({scrollTop: $("#feedback")[0].offsetTop}, "slow");
});
$('.closest-event').click(function() {
    event.preventDefault();
    $('body,html').animate({scrollTop: $("#home-events")[0].offsetTop}, "slow");
});
$(window).scroll(function(){
    if( window.scrollY > 500 )
        $('.to-up').fadeIn(300);
    else
        $('.to-up').fadeOut(300);
});
$('a.to-up').click(function (event) {
    $('body,html').animate({scrollTop: 0}, "slow");
});

$('button[data-tfield="true"]').click(function () {
    var mess = $(this).data('message');
    var id = $(this).data('id');
    $('textarea[name="message"]').val(mess);
    $('body,html').animate({scrollTop: $(id)[0].offsetTop}, "slow");
});

if(window.screen.width < 991){
    $('.messeges').click(function () {
        $(this).toggleClass('open');
    });
}else{
    $('.messeges').hover(function () {
        $(this).toggleClass('open');
    }, function () {
        $(this).toggleClass('open');
    });
}

$('a[data-preview="true"]').click(function(){
    var id = $(this).data('preview-id');

    $.post('action-get-event-preview', {
        'id': id
    }).done(function(data){
        $('#show_event .modal-title').html('<h5 class="modal-title" id="exampleModalLongTitle">' + data.name + '</h5>');
        $('#show_event .modal-body').html('<div class="modal-body">' + data.body + '</div>');
        $('#show_event').modal('show');
    });
});

$('.cases-page a.more').click(function(){
    var page = $(this).data('page');
    $.post('action-get-more-cases', {
        'page': page
    }).done(function(data){
        alert('as');
        $('.cases-page a.more').replaceWith(data);
    });
});

$('button[data-target="#sign_up"]').click(function(){
    $('#sign_up input[name="message"]').val($(this).data('message'));
});

$('ul.bars li').click(function(){
    $(this).children('ul').toggleClass('open');
});
$('body').click(function(e){ 
    var tar = $(e.target);
    if (!tar.parent().hasClass('icon')) {
    $('ul.bars li ul').removeClass('open');
    }
    
    

});