$(document).ready(function () {
  // https://auto.basebuy.ru
  let rucar_mark       = $('#this_rucar_mark');
  let rucar_model      = $('#this_rucar_model');
  let rucar_generation = $('#this_rucar_generation');
  let rucar_serie      = $('#this_rucar_serie');
  let rucar_modification   = $('#this_rucar_modification');
  let rucar_equipment      = $('#this_rucar_equipment');
  let rucar_characteristic = $('#rucar_characteristic');
  //
  const _get_entities = (entity, selector, value = '', prev_ent = '') => {
    //
    let entity_name = {
      mark: 'марку',
      model: 'модель',
      generation: 'поколение',
      serie: 'серию',
      modification: 'модификацию',
      equipment: 'комплектацию'
    };
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
      let html = '<option value="0">Выберите ' + entity_name[entity] + '</option>';
      //
      switch (entity) {
        case 'generation':
          $.each(jsonData, function (key, value) {
            let _entity_id = 'id_car_' + entity;
            html += '<option value="' + value[_entity_id] + '">' + value.name + '[' + value.year_begin + ' - ' + value.year_end + ']</option>';
          });
          break;
        default:
          $.each(jsonData, function (key, value) {
            let _entity_id = 'id_car_' + entity;
            html += '<option value="' + value[_entity_id] + '">' + value.name + '</option>';
          });
          break;
      }
      selector.attr('disabled', false).append(html);
    });
  };
  //
  const _get_characteristic = (selector, value) => {
    $.post('/backend/_get_characteristic.php', {
      value: value
    }).done(function (response) {
      let jsonData = JSON.parse(response);
      let html = '';
      $('#rucar_characteristic').html('');
      //
      $.each(jsonData, function (key, value) {
        html += '<p><b>' + value.name + '</b>: ' + value.value + ' ' + value.unit + '</p>';
      });
      selector.append(html);
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

  // Get modification
  rucar_serie.change(function () {
    _get_entities('modification', rucar_modification, $(this).val(), 'serie');
  });

  // Get equipment
  rucar_modification.change(function () {
    _get_entities('equipment', rucar_equipment, $(this).val(), 'modification');
    _get_characteristic(rucar_characteristic, $(this).val());
  });
});