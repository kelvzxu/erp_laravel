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
    show("#work_information")

    // if work_information click
    $("a.work_information").click(function( event ){
        close();
        unactive();
        $(this).addClass('active');
        show("section#work_information");
        event.preventDefault();
    });

    // if private_information clicked
    $("a.private_information").click(function( event ){
        close();
        unactive();
        $(this).addClass('active');
        show("section#private_information");
        event.preventDefault();
    });

    // if preference clicked
    $("a.preference").click(function( event ){
        close();
        unactive();
        $(this).addClass('active');
        show("section#preference");
        event.preventDefault();
    });
    
})