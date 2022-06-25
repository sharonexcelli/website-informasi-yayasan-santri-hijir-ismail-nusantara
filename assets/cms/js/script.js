
$(document).ready(function () {
  $('.fromNow').each(function () {
    $(this).html(moment($(this).data('date')).fromNow())
  });
  $('#updateProfile').submit(function (e) {
    e.preventDefault()
    let formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: $(this).data('url'),
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (data) {
        swal.fire({
          title: "Success!",
          text: "Success to save update profile!",
          // confirmButtonColor: '#c6b187'
        }).then(function () {
          window.location.reload()
        });
      }
    });
  })
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
    // moment.locale('id')
    $(this).html(moment($(this).data('date')).format($(this).data('format')))
  });
})