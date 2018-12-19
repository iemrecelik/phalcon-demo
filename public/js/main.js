var ajaxRun = true;

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
  },
  beforeSend: (xhr, opts) => {

  	if (ajaxRun)
  		ajaxRun = false;
  	else
  		xhr.abort();
  },
  complete: () => {
  	ajaxRun = true;
  }
});


function update(el)
{ 
  $.ajax({
    method: "POST",
    url: "/masters/save",
    data: $(el).serialize(),
  })
  .done(function( msg ) {
    console.log('done');
    $('div.msgs').html(msg);
  });
}

function create(el)
{ 
  $.ajax({
    method: "POST",
    url: "/masters/create",
    data: $(el).serialize(),
  })
  .done(function( msg ) {
    console.log('done');
    $('div.msgs').html(msg);
  });

  $(el)[0].reset();
}

function deleted(id)
{
  window.location.href = "/masters/delete/"+id;
}

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var modal = $(this);
  modal.find('button.delete').attr('onclick',`deleted(${id})`);
});
