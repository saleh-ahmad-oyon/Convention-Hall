$(document).ready(function(){
    $(".onlyChars").each(function(){$(this).keypress(function(e){var code=e.charCode;
        return (((code>=65)&&(code<=90))||((code>=97)&&(code<=122))||code==32||code==44||code==46||code==0) ? true : false;
    });});
    $(".phnNum").each(function(){$(this).keypress(function(e){var code=e.charCode;
        return (((code>=48)&&(code<=57))||code==0) ? true : false;
    });});
});

jQuery(function($){
    $("#phone").mask("+880-99999999?9999", { "placeholder": "" });
});

function confirmation() {
    var r = confirm("Are you sure ?");
    return r ? true : false;
}