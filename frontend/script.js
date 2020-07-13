$(document).ready(function () {
  // https://auto.basebuy.ru
  let rucar_mark = $('#this_rucar_mark');
  let rucar_model = $('#this_rucar_model');
  let rucar_generation = $('#this_rucar_generation');

  // Get all mark
  $.post('/backend/_get_mark.php', function (response) {
    let jsonData = JSON.parse(response);
    let html = '';
    //
    $.each(jsonData, function (key, value) {
      html += '<option value="' + value.id_car_mark + '">' + value.name + '</option>';
    });
    rucar_mark.append(html);
  });

  // Get models
  rucar_mark.change(function () {
    rucar_model.attr('disabled', true);
    // Clear old model data
    rucar_model.children().remove();
    //
    $.post('/backend/_get_model.php', {value: $(this).val()})
        .done(function (response) {
          let jsonData = JSON.parse(response);
          let html = '<option value="0">Выберите модель</option>';
          $.each(jsonData, function (key, value) {
            html += '<option value="' + value.id_car_model + '">' + value.name + '</option>';
          });
          rucar_model.attr('disabled', false).append(html);
        });
  });

  // Get generation
  rucar_model.change(function () {
    rucar_generation.attr('disabled', true);
    // Clear old model data
    rucar_generation.children().remove();
    //
    $.post('/backend/_get_generation.php', {value: $(this).val()})
        .done(function (response) {
          let jsonData = JSON.parse(response);
          let html = '<option value="0">Выберите поколение</option>';
          $.each(jsonData, function (key, value) {
            html += '<option value="' + value.id_car_generation + '">' + value.name + '</option>';
          });
          rucar_generation.attr('disabled', false).append(html);
        });
  });
});