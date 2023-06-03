import $ from "jquery";
import { Chart } from "chart.js/auto";
import select2 from "select2";



$(document).ready(function(){

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


