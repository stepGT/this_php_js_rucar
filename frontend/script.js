$(document).ready(function () {
  // https://auto.basebuy.ru
  let rucar_mark       = $('#this_rucar_mark');
  let rucar_model      = $('#this_rucar_model');
  let rucar_generation = $('#this_rucar_generation');
  let rucar_serie      = $('#this_rucar_serie');
  //
  const _get_entities = (entity, selector, value = '', prev_ent = '') => {
    //
    if (entity !== 'mark') {
      selector.children().remove();
      selector.attr('disabled', true);
    }
    //
    $.post('/backend/_get_query.php', {
      prev_ent: prev_ent,
      entity: entity,
      value: value
    }).done(function (response) {
      let jsonData = JSON.parse(response);
      let html = '';
      //
      $.each(jsonData, function (key, value) {
        let _entity_id = 'id_car_' + entity;
        html += '<option value="' + value[_entity_id] + '">' + value.name + '</option>';
      });
      selector.attr('disabled', false).append(html);
    });
  };

  // Get all mark
  _get_entities('mark', rucar_mark);

  // Get models
  rucar_mark.change(function () {
    _get_entities('model', rucar_model, $(this).val(), 'mark');
  });

  // Get generation
  rucar_model.change(function () {
    _get_entities('generation', rucar_generation, $(this).val(), 'model');
  });

  // Get serie
  rucar_generation.change(function () {
    _get_entities('serie', rucar_serie, $(this).val(), 'generation');
  });
});