$(function(){
    $('#modal').on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal');
    });

    $(document).on('click', '.showModalButton', function(){
  
      if ($('#modal').hasClass('in')) {
          $('#modal').find('#modalContent')
                  .load($(this).attr('value'));
          document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
      } else {
          $('#modal').modal('show')
                  .find('#modalContent')
                  .load($(this).attr('value'));
          document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
      }
  });
});