$(document).on('change', '.variation-radios input', function() {
  $('select[name="'+$(this).attr('name')+'"]').val($(this).val()).trigger('change');
});
$(document).on('woocommerce_update_variation_values', function() {
  $('.variation-radios input').each(function(index, element) {
    $(element).removeAttr('disabled');
    var thisName = $(element).attr('name');
    var thisVal  = $(element).attr('value');
    if($('select[name="'+thisName+'"] option[value="'+thisVal+'"]').is(':disabled')) {
      $(element).prop('disabled', true);
    }
  });
});