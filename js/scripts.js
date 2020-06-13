document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
});

// Or with jQuery

$(document).ready(function () {
    $('.sidenav').sidenav();
});


$(".dropdown-trigger").dropdown({hover: false});

$(document).ready(function(){
    $('.carousel').carousel({
        padding: 200
    });
});

$(document).ready(function(){
    $('.modal').modal();
});

function lister(){
    document.getElementById('formLister').submit();
}

