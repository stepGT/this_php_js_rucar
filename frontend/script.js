$(document).ready(function () {
  // https://auto.basebuy.ru
  let rucar_mark       = $('#this_rucar_mark');
  let rucar_model      = $('#this_rucar_model');
  let rucar_generation = $('#this_rucar_generation');
  let rucar_serie      = $('#this_rucar_serie');
  //
  const _get_post = (entity, selector, value = '') => {
    //
    if (entity !== 'mark') {
      selector.children().remove();
      selector.attr('disabled', true);
    }
    //
    $.post('/backend/_get_' + entity + '.php', {value: value})
        .done(function (response) {
          let jsonData = JSON.parse(response);
          let html = '';
          //
          $.each(jsonData, function (key, value) {
            let _entity_id = 'id_car_' + entity;
            html += '<option value="' + value[_entity_id] + '">' + value.name + '</option>';
          });
          selector.append(html);
          selector.attr('disabled', false).append(html);
        });
  };

  // Get all mark
  _get_post('mark', rucar_mark);

  // Get models
  rucar_mark.change(function () {
    _get_post('model', rucar_model, $(this).val());
  });

  // Get generation
  rucar_model.change(function () {
    _get_post('generation', rucar_generation, $(this).val());
  });

  // Get serie
  rucar_generation.change(function () {
    _get_post('serie', rucar_serie, $(this).val());
  });
});