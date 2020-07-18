jQuery(document).ready(function ($) {
  console.log('back-service.js');

  // Azioni da eseguire al click su "Aggiungi un servizio extra"
  let counter = 1;
  $('.quoma-add-extra-service').on('click', function () {
    // Aggiungi un nuovo box per i servizi extra
    let extraServiceBox =
      '<div class="quoma-box-extra-service">' +
      '<h2 style="font-weight: bold;">Servizio extra ' + counter + '</h2>' +
      '<p>Nome: <input type="text" name="_extra_name[]" value="" /></p>' +
      '<p>Descrizione: <input type="text" name="_extra_description[]" value="" /></p>' +
      '<p>Prezzo: <input type="number" name="_extra_price[]" value="" /></p>' +
      '</div>';
    $('.quoma-container-extra-service').append(extraServiceBox);
    counter++;
  });
});
