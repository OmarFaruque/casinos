import $ from "jquery";
import { Chart } from "chart.js/auto";
import select2 from "select2";
import DataTable from 'datatables.net-dt';



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


    // Data table 
    if($('.dataTableCasinoDone').length){
      $('.dataTable').dataTable({
        scrollX: true,
        'autoWidth': true, 
        "columnDefs": [
          { "width": "100px", "targets": 0 }, 
          { "width": "150px", "targets": 1 }, 
          { "width": "120px", "targets": 2 }, 
          { "width": "70px", "targets": 3 }, 
          { "width": "150px", "targets": 4 }, 
          { "width": "180px", "targets": 5 }, 
          { "width": "160px", "targets": 9 },
          { "width": "130px", "targets": 10 }, 
          { "width": "50px", "targets": 12 }
        ]
        // scrollCollapse: true,
      });
    }

    // Bonus Table 
    if($('.dataTableBonusLists').length){
      $('.dataTableBonusLists').dataTable({
        scrollX: true,
        'autoWidth': true, 
        "columnDefs": [
          { "width": "100px", "targets": 0 }, 
          { "width": "110px", "targets": 1 }, 
          { "width": "110px", "targets": 2 }, 
          { "width": "70px", "targets": 3 }, 
          { "width": "100px", "targets": 4 }, 
          { "width": "80px", "targets": 5 }, 
          { "width": "130px", "targets": 7 }, 
          { "width": "160px", "targets": 9 },
          { "width": "130px", "targets": 10 }, 
          { "width": "150px", "targets": 11 }, 
          { "width": "150px", "targets": 12 },
          { "width": "130px", "targets": 13 },
          { "width": "130px", "targets": 14 },
          { "width": "130px", "targets": 15 }
        ]
        // scrollCollapse: true,
      });
    }

    if($('.dataTableWorkers').length){
      $('.dataTableWorkers').dataTable({
        scrollX: true,
        'autoWidth': true, 
        "columnDefs": [
          { "width": "200px", "targets": 0 }, 
          { "width": "150px", "targets": 1 }, 
          { "width": "120px", "targets": 2 }, 
          { "width": "auto", "targets": 3 }
        ]
        // scrollCollapse: true,
      }); 
      $('table.dataTableWorkers, table.dataTable').css('width', '100%');
      $('div.dataTables_scroll, div.dataTables_scrollHeadInner').css('width', '100%');
    }

    if($('.dataTableIncomentPayment').length){
      $('.dataTableIncomentPayment').dataTable({
        scrollX: true,
        'autoWidth': true, 
        "columnDefs": [
          { "width": "200px", "targets": 0 }, 
          { "width": "100px", "targets": 1 }, 
          { "width": "150px", "targets": 2 }, 
          { "width": "150px", "targets": 3 }, 
          { "width": "150px", "targets": 11 }
        ]
        // scrollCollapse: true,
      }); 
    } 

    

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




  // Add new casiono done in list
if($('#addNewCasinoDone').length){
  var newItems = {
    casinoDoneBtn : document.getElementById('addNewCasinoDone'),
    gnomes : $('.dataTableCasinoDone').data('gnomes'), 
    types: $('.dataTableCasinoDone').data('types'), 
    casinos: $('.dataTableCasinoDone').data('casinos'),
    groups: $('.dataTableCasinoDone').data('groups'), 
    payment_methods: $('.dataTableCasinoDone').data('payment_methods'), 
    statuslists: $('.dataTableCasinoDone').data('statuslists'), 
    slots: $('.dataTableCasinoDone').data('slots'), 
    action: $('.dataTableCasinoDone').data('action'),
    action_casinogroup: $('.dataTableCasinoDone').data('action_casinogroup'), 
    token: $('.dataTableCasinoDone').data('token'), 
    worker_id: $('.dataTableCasinoDone').data('worker_id')
  }

  newItems.casinoDoneBtn.addEventListener('click', function(){
    
    let newItemHTML = '<tr>'
                      +'<td><select name="name" id="name" class="h-11 border rounded p-2 mr-2 shadow w-full">'
                      +'<option value="">Name...</option>'; 
                      for(var i = 0; i < newItems.gnomes.length; i++){
                        newItemHTML +='<option value="'+newItems.gnomes[i].id+'">'+newItems.gnomes[i].name+'</option>'
                      }
                      newItemHTML += '</select></td>'
                      +'<td class="px-2 py-3  table-cell"><input type="date" name="date" class="border rounded p-2 mr-2 w-full shadow" id="date"></td>'
                      +'<td><select name="type" id="type" class="border rounded p-2 mr-2 h-11 shadow w-full">'
                      +'<option value="">Type...</option>';
                      for(let v in newItems.types){
                        newItemHTML +='<option value="'+v+'">'+newItems.types[v]+'</option>'
                      };
                      +'</select></td>';
                      newItemHTML+= '<td> <select name="casino" id="casino" class="listcasino border rounded p-2 h-11 mr-2 shadow w-full">'
                      +'<option value="">Select Casino...</option>';
                      for(var i = 0; i < newItems.casinos.length; i++){
                        newItemHTML +='<option value="'+newItems.casinos[i].id+'">'+newItems.casinos[i].name+'</option>'
                      }
                      +'</select></td>';
                      newItemHTML+= '<td> <select name="group" id="group" class="border rounded p-2 h-11 mr-2 shadow w-full">'
                      +'<option value="">Select a group...</option>';
                      // for(var i = 0; i < newItems.groups.length; i++){
                      //   newItemHTML +='<option value="'+newItems.groups[i].id+'">'+newItems.groups[i].name+'</option>'
                      // }
                      +'</select></td>';
                      newItemHTML+='<td><select class="border rounded p-2 mr-2 shadow w-full h-11" name="payment_method" id="payment_method">'
                      +'<option value="">Payment Method...</option>'; 
                      for(let v in newItems.payment_methods){
                        newItemHTML +='<option value="'+v+'">'+newItems.payment_methods[v]+'</option>'
                      };
                      +'</select></td>'; 
                      newItemHTML+= '<td><input type="number" name="deposit" class="border rounded p-2 mr-2 shadow w-full" id="deposit" value=""></td>'
                      +'<td><input type="number" name="bonus" class="border rounded p-2 mr-2 shadow w-full" id="bonus" value=""></td>'
                      +'<td><input type="number" name="balance" class="border rounded p-2 mr-2 shadow w-full" id="balance" value=""></td>'; 
                      newItemHTML+= '<td><select name="status" id="status" class="border rounded h-11 p-2 mr-2 shadow w-full" >';
                      for(let v in newItems.statuslists){
                        newItemHTML +='<option value="'+v+'">'+newItems.statuslists[v]+'</option>'
                      }; 
                      +'</select></td>';
                      newItemHTML+= '<td><select name="game_played" id="game_played" class="h-11 border rounded p-2 mr-2 shadow w-full">'
                      +'<option value="">Select a slot</option>'
                      for(var i = 0; i < newItems.slots.length; i++){
                        newItemHTML +='<option value="'+newItems.slots[i].id+'">'+newItems.slots[i].name+'</option>'
                      }
                      +'</select></td>';
                      newItemHTML+='<td><input type="number" name="rtp" class="border rounded p-2 mr-2 shadow w-full" id="rtp" min="0" step="0.01" max="100" value=""></td>'
                      newItemHTML+='<td><input type="number" name="spin" class="border rounded p-2 mr-2 shadow w-full" id="spin" min="0" step="1" value=""></td>'
                      newItemHTML+='<td class="px-2 py-3 table-cell gap-1 action"> <div class="flex gap-2">'
                      +'<button type="submit" class="submitQuickCasinoDone notDone px-3 py-3 border rounded hover:text-gray-50 hover:bg-green-500">'
                      +'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">'
                      +'<path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>'
                      +'</svg>'
                      +'</button>'
                      +'<button type="submit" class="px-3 py-3 border rounded hover:text-gray-50 hover:bg-red-500">'
                      +'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">'
                          +'<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>'
                      +'</svg>'
                      +'</button></div></td>'
                      +'</tr>';

    $('table.dataTableCasinoDone tbody').append(newItemHTML);
  });
}

  //Existing data edit 
  $(document.body).on('click', 'a.quickEdit', function(e){
    e.preventDefault();
    $(this).hide();
    var tr = $(this).closest('tr');
    tr.children('td').find('span').hide();
    let done = tr.data('done');


    // Name 
    var nameHtml = '<select name="name" id="name" class="h-11 border rounded p-2 mr-2 shadow w-full">'
    +'<option value="">Name...</option>'; 
    for(var i = 0; i < newItems.gnomes.length; i++){
      let selected = newItems.gnomes[i].id == done.gnome_id ? "selected":"";
      nameHtml +='<option '+ selected +' value="'+newItems.gnomes[i].id+'">'+newItems.gnomes[i].name+'</option>'
    }
    nameHtml += '</select>';

    // Types 
    var types = '<select name="type" id="type" class="border rounded p-2 mr-2 h-11 shadow w-full">'
                      +'<option value="">Type...</option>';
                      for(let v in newItems.types){
                        let selectedType = v==done.type ? 'selected' : '';
                        types +='<option '+selectedType+' value="'+v+'">'+newItems.types[v]+'</option>'
                      };
                      +'</select>';

    // Casino 
    var casinoHtml = '<select name="casino" id="casino" class="border listcasino rounded p-2 mr-2 h-11 shadow w-full">'
                    +'<option value="">Select Casino...</option>';
                    for(var i = 0; i < newItems.casinos.length; i++){
                      let selectedCasino = newItems.casinos[i].id == done.casino ? 'selected' : '';
                      casinoHtml +='<option '+selectedCasino+' value="'+newItems.casinos[i].id+'">'+newItems.casinos[i].name+'</option>'
                    }
                    +'</select>';

    //Group
    var groupHtml = '<select name="group" id="group" class="border rounded p-2 h-11 mr-2 shadow w-full">'
                      +'<option value="">Select Group...</option>';
                      if(done.group_id){
                        
                        groupHtml +='<option selected value="'+done.group_id+'">'+done.group+'</option>'
                      }
                      +'</select>';

    // Payment methods
     let pmethodHTML ='<select class="border rounded p-2 mr-2 shadow w-full h-11" name="payment_method" id="payment_method">'
                      +'<option value="">Payment Method...</option>'; 
                      for(let v in newItems.payment_methods){
                        let selectedMethod = v == done.payment_method ? 'selected':'';
                        pmethodHTML +='<option '+selectedMethod+' value="'+v+'">'+newItems.payment_methods[v]+'</option>'
                      };
                      +'</select>'; 

    // Status 
    let statusHTML = '<select name="status" id="status" class="border rounded h-11 p-2 mr-2 shadow w-full" >';
                      for(let v in newItems.statuslists){
                        let selectedStatus = v == done.status ? 'selected' : '';
                        statusHTML +='<option '+selectedStatus+' value="'+v+'">'+newItems.statuslists[v]+'</option>'
                      }; 
                      +'</select>';

    // Game Played
    console.log('newItems: ', newItems);
    let gameHTML = '<select name="game_played" id="game_played" class="h-11 border rounded p-2 mr-2 shadow w-full">'
                  +'<option value="">Select a slot</option>'
                  for(var i = 0; i < newItems.slots.length; i++){
                    let selectedGame = newItems.slots[i].id == done.slot_id ? 'selected' : '';
                    gameHTML +='<option '+selectedGame+' value="'+newItems.slots[i].id+'">'+newItems.slots[i].name+'</option>'
                  }
                  +'</select>';

    tr.children('td.name').append(nameHtml);
    tr.children('td.date').append('<input type="date" value="'+done.date+'" name="date" class="border rounded p-2 mr-2 w-full shadow" id="date">');
    tr.children('td.type').append(types);
    tr.children('td.casino').append(casinoHtml);
    tr.children('td.group').append(groupHtml);
    tr.children('td.payment_method').append(pmethodHTML);
    tr.children('td.deposit').append('<input type="number" name="deposit" class="border rounded p-2 mr-2 shadow w-full" id="deposit" value="'+done.deposit+'">');
    tr.children('td.bonus').append('<input type="number" name="bonus" class="border rounded p-2 mr-2 shadow w-full" id="bonus" value="'+done.bonus+'">');
    tr.children('td.balance').append('<input type="number" name="balance" class="border rounded p-2 mr-2 shadow w-full" id="balance" value="'+done.balance+'">');
    tr.children('td.status').append(statusHTML);
    tr.children('td.slot_name').append(gameHTML);
    tr.children('td.rtp').append('<input type="number" name="rtp" class="border rounded p-2 mr-2 shadow w-full" id="rtp" min="0" step="0.01" max="100" value="'+done.rtp+'">');
    tr.children('td.spin').append('<input type="number" name="spin" class="border rounded p-2 mr-2 shadow w-full" id="spin" min="0" step="1" value="'+done.spin+'">');
    tr.children('td.action').find('a.pEdit').addClass('hrefBlock hover:bg-green-500').removeClass('hover:bg-gray-800').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>');
  });





  //Overview on change workers 
  if($('.overviewWorker').length){
    $(document.body).on('change', 'select[name="worker"].overviewWorker', function(){

        let worker_id = $(this).val(), 
        form = $(this).closest('form'),
        _token = form.data('token'),
        _action = form.data('action'),
        overflowGnome = $('select[name="gnome"].overflowgnome'), 
        gnomeOptions = ''

        let data = {
          worker_id: worker_id,
          _token : _token
        }
        $.ajax({
            url: _action,
            method: 'POST',
            data: data,
            dataType: 'JSON',
            success:function(response)
            {
              overflowGnome.html('<option value="">All</option>');
              for(var i = 0; i < response.gnomes.length; i++){
                gnomeOptions +='<option value="'+response.gnomes[i].id+'">'+response.gnomes[i].name+'</option>'
              }
              overflowGnome.append(gnomeOptions);
              
            },
            error: function(response) {
              console.log('errors: ', response);
            }
        });
    });
  }


  // Append group while casino change from dropdown
  $(document.body).on('change', 'select[name="casino"].listcasino', function(){

    let groupOptions = '',
    tr = $(this).closest('tr'),
    done = tr.data('done'), 
    casino_id = $(this).val();

    // remove existing dropdown from groups lists
    tr.find('select[name="group"]').html('<option value="">Select Group...</option>');


    let data = {
      casino_id: casino_id,
      _token : newItems.token
    }
    $.ajax({
        url: newItems.action_casinogroup,
        method: 'POST',
        data: data,
        dataType: 'JSON',
        success:function(response)
        {
          for(var i = 0; i < response.groups.length; i++){
            let selectedGroup = typeof done != 'undefined' && response.groups[i].id == done.group_id ? 'selected' : '';
            groupOptions +='<option '+selectedGroup+' value="'+response.groups[i].id+'">'+response.groups[i].name+'</option>'
          }
          tr.find('select[name="group"]').append(groupOptions);
          
        },
        error: function(response) {
          console.log('errors: ', response)
        }
    });
  });


  //Submit Update
  $(document.body).on('click', 'a.pEdit.hrefBlock', function(e){
      e.preventDefault();
      $(this).removeClass('hrefBlock');
      

      let tr = $(this).closest('tr'),
      done = tr.data('done'),
      url = $(this).data('url'),
      data = {
        name            : tr.find('select[name="name"]').val(), 
        date            : tr.find('input[name="date"]').val(), 
        type            : tr.find('select[name="type"]').val(), 
        group           : tr.find('select[name="group"]').val(), 
        payment_method  : tr.find('select[name="payment_method"]').val(), 
        deposit         : tr.find('input[name="deposit"]').val(), 
        bonus           : tr.find('input[name="bonus"]').val(), 
        balance         : tr.find('input[name="balance"]').val(),
        status          : tr.find('select[name="status"]').val(), 
        game_played     : tr.find('select[name="game_played"]').val(), 
        rtp             : tr.find('input[name="rtp"]').val(), 
        spin             : tr.find('input[name="spin"]').val(),
        _method         : "PATCH",
        _token          : newItems.token
      }

      
      $.ajax({
        url: url,
        // method: 'POST',
        type: 'PATCH',
        data: data,
        dataType: 'JSON',
        success:function(response)
        {
          let slotIndex = newItems.slots.findIndex(p => p.id == response.done.game_played),
          nameIndex = newItems.gnomes.findIndex(p => p.id == response.done.name),
          groupIndex = newItems.groups.findIndex(p => p.id == response.done.group);


          tr.children('td.rtp').find('span').text(response.done.rtp);
          tr.children('td.spin').find('span').text(response.done.spin);
          tr.children('td.slot_name').find('span').text(slotIndex >= 0 ? newItems.slots[slotIndex].name : '');
          tr.children('td.status').find('span').text(newItems.statuslists[response.done.status]);
          tr.children('td.balance').find('span').text(response.done.balance);
          tr.children('td.bonus').find('span').text(response.done.bonus);
          tr.children('td.deposit').find('span').text(response.done.deposit);
          tr.children('td.payment_method').find('span').text(newItems.payment_methods[response.done.payment_method]);
          tr.children('td.group').find('span').text(groupIndex >= 0 ? newItems.groups[groupIndex].name : '');
          tr.children('td.date').find('span').text(response.done.date);
          tr.children('td.name').find('span').text(newItems.gnomes[nameIndex].name);
          tr.children('td').find('input, select').remove();
          tr.children('td').find('span').show();
          tr.children('td.action').find('a.pEdit').addClass('hover:bg-gray-800').removeClass('hover:bg-green-500').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>');
          tr.children('td.name').find('a.quickEdit').show();
        },
        error: function(response){
          for(let v in response.responseJSON.errors){
            $('input[name="'+v+'"], select[name="'+v+'"]').addClass('border-orange-600');
          }
        }
    });
  });

  $(document.body).on('click', 'button.submitQuickCasinoDone.notDone', function(){
     $(this).removeClass('notDone');
      let tr = $(this).closest('tr'),
      data = {
        name            : tr.find('select[name="name"]').val(), 
        date            : tr.find('input[name="date"]').val(), 
        type            : tr.find('select[name="type"]').val(), 
        group           : tr.find('select[name="group"]').val(), 
        payment_method  : tr.find('select[name="payment_method"]').val(), 
        deposit         : tr.find('input[name="deposit"]').val(), 
        bonus           : tr.find('input[name="bonus"]').val(), 
        balance         : tr.find('input[name="balance"]').val(),
        status          : tr.find('select[name="status"]').val(), 
        game_played     : tr.find('select[name="game_played"]').val(), 
        casino          : tr.find('select[name="casino"]').val(), 
        rtp             : tr.find('input[name="rtp"]').val(), 
        spin            : tr.find('input[name="spin"]').val(), 
        _token          : newItems.token
      }
      $.ajax({
        url: newItems.action,
        method: 'POST',
        data: data,
        dataType: 'JSON',
        success:function(response)
        {
          
          console.log('response: ', response);

          var nameIndex = newItems.gnomes.findIndex(p => p.id == data.name);
          var groupIndex = newItems.groups.findIndex(p => p.id == data.group);
          let casinoIndex = newItems.casinos.findIndex(p => p.id == data.casino);
          let slotIndex = newItems.slots.findIndex(p => p.id == data.game_played);

          let SelectedCasino = casinoIndex > -1 ? newItems.casinos[casinoIndex].name : "", 
          selectedGroup = groupIndex > -1 ? newItems.groups[groupIndex].name : "", 
          selectedgamePlayed = slotIndex > -1 ? newItems.slots[slotIndex].name : "";
          // console.log('responseis: ', newItems.casinos, 'group index: ', casinoIndex, 'printI: ', printI);

          tr.find('select[name="name"]').hide().closest('td').append('<span>'+newItems.gnomes[nameIndex].name+'</span>');
          tr.find('input[name="date"]').hide().closest('td').append('<span>'+data.date+'</span>');
          tr.find('select[name="type"]').hide().closest('td').append('<span>'+data.type+'</span>');
          tr.find('select[name="group"]').hide().closest('td').append('<span>'+selectedGroup+'</span>');
          tr.find('select[name="casino"]').hide().closest('td').append('<span>'+SelectedCasino+'</span>');
          tr.find('input[name="rtp"]').hide().closest('td').append('<span>'+data.rtp+'</span>');
          tr.find('input[name="spin"]').hide().closest('td').append('<span>'+data.spin+'</span>');
          tr.find('select[name="status"]').hide().closest('td').append('<span>'+data.status+'</span>');
          tr.find('input[name="balance"]').hide().closest('td').append('<span>'+data.balance+'</span>');
          tr.find('input[name="bonus"]').hide().closest('td').append('<span>'+data.bonus+'</span>');
          tr.find('input[name="deposit"]').hide().closest('td').append('<span>'+data.deposit+'</span>');
          tr.find('select[name="game_played"]').hide().closest('td').append('<span>'+selectedgamePlayed+'</span>');
          
          tr.find('select[name="payment_method"]').hide().closest('td').append('<span>'+newItems.payment_methods[data.payment_method]+'</span>');
          tr.children('td.action').find('a.pEdit').addClass('hover:bg-gray-800').removeClass('hover:bg-green-500').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>');
          // tr.children('td.name').find('a.quickEdit').show();
          
        },
        error: function(response) {
          for(let v in response.responseJSON.errors){
            $('input[name="'+v+'"], select[name="'+v+'"]').addClass('border-orange-600');
          }
        }
    });
      
  })


});