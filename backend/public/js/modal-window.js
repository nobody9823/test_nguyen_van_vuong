function toggleModal(id) {
  if (id.includes('open_modal_')) {
    var comment_id = id.replace('open_modal_', '');
  } else if (id.includes('close_modal_')) {
    var comment_id = id.replace('close_modal_', '');
  }
  
  let modalArea = document.getElementById('modal_area_' + comment_id);
  modalArea.classList.toggle('is_show');
}