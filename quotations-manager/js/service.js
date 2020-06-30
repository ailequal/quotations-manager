jQuery(document).ready(function ($) {
  console.log('service.js');

  $('#quoma-request-quotation').on('click', function () {
    $('#quoma-extras-list').show();
    $('#quoma-request-quotation').hide();
  });

  // Chiamata AJAX per la creazione di un nuovo preventivo
  $.ajax({
    url: service.ajax_url,
    method: "POST",
    dataType: 'json',
    data: {
      action: 'quoma_create_quotation',
      nonce: service.nonce,
      service_id: service.service_id
    },
    success: function (response, data, state) {
      console.log(response);
    },
    error: function (request, state, error) {
      console.log(error);
    }
  });
});
