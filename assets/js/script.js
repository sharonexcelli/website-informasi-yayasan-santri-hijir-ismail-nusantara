$('document').ready(function () {
  $('.copytext').on('click', function (e) {
    e.preventDefault()
    const el = document.createElement('textarea');
    el.value = $(this).data('text');
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    swal.fire({
      title: "Success!",
      text: "Success copy to clipboard!",
    })
  })
  $('.getDate').each(function (i, obj) {
    moment.locale('id')
    $(this).html(moment($(this).data('date')).format($(this).data('format')))
  });
})