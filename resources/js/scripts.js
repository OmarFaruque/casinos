import $ from "jquery";
import { Chart } from "chart.js/auto";
import select2 from "select2";



$(document).ready(function($){

  // Collespe left sidebar 
  let collespe_button = document.getElementById('collespe_left');
  if($(collespe_button).length){
    collespe_button.addEventListener('click', function(){
      if($(this).hasClass('closped')){
        $(this).animate({deg: 0}, {
          duration: 200, 
          step: function(now){
            $(this).css({transform: 'rotate(' + now + 'deg)'})
          }
        })

        $(this).closest('#leftSidebar').css({minWidth: '200px', width: 'auto'});
        $(this).next('div').show();
        $(this).removeClass('closped');
      }else{
        $(this).animate({deg: 180}, {
          duration: 200, 
          step: function(now){
            $(this).css({transform: 'rotate(' + now + 'deg)'})
          }
        })

        $(this).closest('#leftSidebar').css({minWidth: 'unset', width: '50px'});
        $(this).next('div').hide();
        $(this).addClass('closped');
      }
    });
  }
  // left sidebar height
   let mainHeight = $('main').height();
   $('#leftSidebar').height(mainHeight);


    let profileMenu = document.getElementById('profileMenu');
    if($(profileMenu).length){
      profileMenu.addEventListener('click', function(){
          document.getElementById('dropdown-profile').classList.toggle("hidden");
      });
    }


    $(document.body).on('click', '.casino-dropdown', function(){
        $(this).next('ul').slideToggle();
    });

    // Select2 
    $('.select2').select2();



    // Cart

    const ctx = document.getElementById('profitChart');
    if($(ctx).length){
      const profits = $(ctx).data('profits').map(function(v){ return v.profit});
      const dates = $(ctx).data('profits').map(function(v){ return v.date});
      const ev = $(ctx).data('profits').map(function(v){ return v.ev});
      
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: dates,
          datasets: [
          {
            label: 'Profit',
            data: profits,
            borderWidth: 1
          }, 
          {
              label: 'EV',
              data: ev,
              borderWidth: 1
            }
          ]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }

});


