import $ from "jquery";

import select2 from "select2";

let profileMenu = document.getElementById('profileMenu');
profileMenu.addEventListener('click', function(){
    document.getElementById('dropdown-profile').classList.toggle("hidden");
});

$(document).ready(function(){
    $(document.body).on('click', '.casino-dropdown', function(){
        $(this).next('ul').slideToggle();
    });

    // Select2 
    $('.select2').select2();
});

