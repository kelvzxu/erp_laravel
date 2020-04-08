function close (){
    const close = document.querySelectorAll("section");
    close.forEach(function (el) {
        el.style.display = 'none';
    });
}
function show(element){
    $(element).css( "display", "" );
}
function unactive(){
    $('.nav-link').removeClass('active');
}
 
$(function () {
    close();
    show("#privateinformation")

    // if privateinformation click
    $("a.privateinformation").click(function( event ){
        close();
        unactive();
        $(this).addClass('active');
        show("section#privateinformation");
        event.preventDefault();
    });

    // if jobs position clicked
    $("a.jobsposition").click(function( event ){
        close();
        unactive();
        $(this).addClass('active');
        show("section#jobsposition");
        event.preventDefault();
    });

    // if User Account clicked
    $("a.useraccount").click(function( event ){
        close();
        unactive();
        $(this).addClass('active');
        show("section#useraccount");
        event.preventDefault();
    });
    
})