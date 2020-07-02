jQuery(document).ready(function ($) {
  console.log('service.js');

  // Al click su "Richiedi un preventivo", mostra interfaccia per servizi extra
  $('#quoma-request-quotation').on('click', function () {
    $('#quoma-extras-list').show();
    $('#quoma-request-quotation').hide();
  });

  // Azioni da eseguire al click su "Invia un preventivo"
  $('#quoma-create-quotation').on('click', function () {
    // Recuperare i dati dei servizi extra selezionati dall'utente
    let extras_selected = [];
    $('.quoma-extra').each(function () {
      // Controllo che il servizio extra sia stato selezionato
      if ($(this).find('input').is(':checked')) {
        // Salvataggio dati in un oggetto
        let extra = {
          'name': $(this).find('label').text(), // name
          'description': $(this).find('p').text(), // description
          'price': $(this).find('span').text(), // price
          'slug': $(this).find('input').val(), // slug
        };
        extras_selected.push(extra);
      }
    });
    extras_selected = JSON.stringify(extras_selected);

    // Chiamata AJAX per la creazione di un nuovo preventivo
    $.ajax({
      url: service.ajax_url,
      method: "POST",
      dataType: 'json',
      data: {
        action: 'quoma_create_quotation',
        nonce: service.nonce,
        service_id: service.service_id,
        extras_selected: extras_selected,
      },
      success: function (response, data, state) {
        console.log(response);
      },
      error: function (request, state, error) {
        console.log(error);
      }
    });
  });
});
