$("input[type='checkbox']").change(function() {
  var list = "";

  $("input[type='checkbox']").each(function() {
    if (this.checked) {
      list = list + '.' + $(this).attr('id');
    }
  });

  if (list !== '') {
    $("div.disciplinas-item").hide();
    $(list).show();
  } else {
    $("div.disciplinas-item").show();
  }
});
