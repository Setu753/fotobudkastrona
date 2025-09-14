// Oferta toggle
const toggle = document.getElementById("ofertaToggle");
const list   = document.getElementById("listaPakietow");
const navOferta = document.getElementById("navOferta");

function setVisible(show){
  list.classList.toggle("show", show);
  list.hidden = !show;
  toggle.setAttribute("aria-expanded", show ? "true" : "false");
}
function toggleList(){
  const show = list.hidden;
  setVisible(show);
  if(show){ toggle.scrollIntoView({behavior:"smooth", block:"start"}); }
}
toggle.addEventListener("click", toggleList);
navOferta.addEventListener("click", ()=>{ setTimeout(()=>{ if(list.hidden) setVisible(true); }, 60); });

// Akordeon wewnątrz kategorii
document.querySelectorAll(".kategoria").forEach(item=>{
  const btn = item.querySelector("button");
  const content = item.querySelector(".content");
  btn.addEventListener("click", ()=>{
    const open = !item.classList.contains("open");
    item.classList.toggle("open", open);
    btn.setAttribute("aria-expanded", open ? "true" : "false");
    content.hidden = !open;
  });
});

