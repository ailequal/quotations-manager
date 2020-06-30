jQuery(document).ready(function ($) {
  console.log('service.js');

  // AJAX test con quoma_sum
  var data = {
    'action': 'quoma_sum',
    'number': service.number
  };
  jQuery.post(service.ajax_url, data, function (response) {
    alert('La somma finale ammonta a: ' + response);
  });
});
