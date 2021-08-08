(function () {
  const modal_area = document.getElementById('modal_area');
  const open_modal = document.getElementById('open_modal');
  const close_modal = document.getElementById('close_modal');
  const modal_bg = document.getElementById('modal_bg');
  const toggle = [open_modal,close_modal,modal_bg];
  
  for(let i=0, len=toggle.length ; i<len ; i++){
    toggle[i].addEventListener('click',function(){
      modal_area.classList.toggle('is_show');
    },false);
  }
}());