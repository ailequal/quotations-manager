jQuery(document).ready(function ($) {
  console.log('back-service.js');

  // Azioni da eseguire al click su "Aggiungi un servizio extra"
  let counter = $('.quoma-box-extra-service').length + 1;
  $('.quoma-add-extra-service').on('click', function () {
    // Aggiungi un nuovo box per i servizi extra
    let extraServiceBox =
      '<div class="quoma-box-extra-service">' +
      '<h2 style="font-weight: bold;">Servizio extra ' + counter + '</h2>' +
      '<p>Nome: <input type="text" name="_extra_name[]" value="" /></p>' +
      '<p>Descrizione: <input type="text" name="_extra_description[]" value="" /></p>' +
      '<p>Prezzo: <input type="number" name="_extra_price[]" value="" /></p>' +
      '<button class="quoma-extra-service-delete" type="button">Cancella il servizio extra ' + counter + '</button>' +
      '</div>';
    $('.quoma-container-extra-service').append(extraServiceBox);
    counter++;
  });

  // Azioni da eseguire al click su "Cancella il servizio extra"
  $('.quoma-container-extra-service').on('click', '.quoma-extra-service-delete', function () {
    // Cancella il box selezionato
    console.log($(this).parent('.quoma-box-extra-service').remove());
  });

});
