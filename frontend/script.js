$(document).ready(function () {
  // https://auto.basebuy.ru
  let rucar_mark       = $('#this_rucar_mark');
  let rucar_model      = $('#this_rucar_model');
  let rucar_generation = $('#this_rucar_generation');
  let rucar_serie      = $('#this_rucar_serie');
  let rucar_modification   = $('#this_rucar_modification');
  let rucar_equipment      = $('#this_rucar_equipment');
  let rucar_characteristic = $('#rucar_characteristic');
  let rucar_option         = $('#rucar_option');
  // Constants
  const ENTITY_MARK           = 'mark';
  const ENTITY_MODEL          = 'model';
  const ENTITY_GENERATION     = 'generation';
  const ENTITY_SERIE          = 'serie';
  const ENTITY_MODIFICATION   = 'modification';
  const ENTITY_EQUIPMENT      = 'equipment';
  const ENTITY_CHARACTERISTIC = 'characteristic';
  const ENTITY_OPTION         = 'option';
  /**
   *
   * @param entity
   * @param selector
   * @param value
   * @private
   */
  const _get_entities = (entity, selector, value = '') => {
    //
    let entity_name = {
      [ENTITY_MARK]: 'марку',
      [ENTITY_MODEL]: 'модель',
      [ENTITY_GENERATION]: 'поколение',
      [ENTITY_SERIE]: 'серию',
      [ENTITY_MODIFICATION]: 'модификацию',
      [ENTITY_EQUIPMENT]: 'комплектацию'
    };
    //
    if (entity !== ENTITY_MARK) {
      selector.children().remove();
      selector.attr('disabled', true);
    }
    //
    $.post('/backend/_get_query.php', {
      entity: entity,
      value: value
    }).done(function (response) {
      let jsonData = JSON.parse(response);
      let html = entity !== ENTITY_CHARACTERISTIC ? '<option value="0">Выберите ' + entity_name[entity] + '</option>' : '';
      //
      switch (entity) {
        case ENTITY_CHARACTERISTIC:
          $.each(jsonData, function (key, value) {
            let unit = value.unit ? value.unit : '';
            html += '<p><b>' + value.name + '</b>: ' + value.value + ' ' + unit + '</p>';
          });
          break;
        case ENTITY_GENERATION:
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

  // Get all mark
  _get_entities(ENTITY_MARK, rucar_mark);

  // Get models
  rucar_mark.change(function () {
    _get_entities(ENTITY_MODEL, rucar_model, $(this).val(), ENTITY_MARK);
  });

  // Get generation
  rucar_model.change(function () {
    _get_entities(ENTITY_GENERATION, rucar_generation, $(this).val(), ENTITY_MODEL);
  });

  // Get serie
  rucar_generation.change(function () {
    _get_entities(ENTITY_SERIE, rucar_serie, $(this).val(), ENTITY_GENERATION);
  });

  // Get modification
  rucar_serie.change(function () {
    _get_entities(ENTITY_MODIFICATION, rucar_modification, $(this).val(), ENTITY_SERIE);
  });

  // Get equipment
  rucar_modification.change(function () {
    _get_entities(ENTITY_EQUIPMENT, rucar_equipment, $(this).val());
    _get_entities(ENTITY_CHARACTERISTIC, rucar_characteristic, $(this).val());
  });

  // Get option
  rucar_equipment.change(function () {
    //_get_char_opt(ENTITY_OPTION, rucar_option, $(this).val());
  });
});