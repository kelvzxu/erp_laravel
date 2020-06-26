$('a#inventory_report').addClass('mm-active');
$('a#inventory_valuation').addClass('mm-active');

$(".o_group_has_content").click(function() {
    if($('.' + this.id).css('display')=='none'){
        $(this).children("th").find("span").removeClass('fa-caret-right');
        $(this).children("th").find("span").addClass('fa-caret-down');
        $(this).addClass('o_group_open');
        console.log($('.' + this.id).css("display", "" ));
    }else{
        $(this).children("th").find("span").addClass('fa-caret-right');
        $(this).children("th").find("span").removeClass('fa-caret-down');
        $(this).removeClass('o_group_open');
        console.log($('.' + this.id).css("display", "none" ));
    }
});