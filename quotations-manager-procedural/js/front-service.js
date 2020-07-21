jQuery(document).ready(function ($) {
  console.log('front-service.js');

  // Al click su "Richiedi un preventivo", mostra interfaccia per servizi extra
  $('#quoma-request-quotation').on('click', function () {
    $('#quoma-extras-list').show();
    $('#quoma-request-quotation').hide();
  });

});
