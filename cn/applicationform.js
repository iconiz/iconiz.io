$.ajax({
  type: form.attr('method'),
  url: form.attr('action'),
  data: form.serialize()
}).success(function() {
  //成功提交
}).fail(function(jqXHR, textStatus, errorThrown) {
  //错误信息
});
