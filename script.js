const toast = document.getElementById('toast');
let toastTimer;
function showToast(message){toast.textContent=message;toast.classList.add('show');clearTimeout(toastTimer);toastTimer=setTimeout(()=>toast.classList.remove('show'),2600)}

document.querySelectorAll('.tab').forEach(tab=>tab.addEventListener('click',()=>{
  document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
  tab.classList.add('active');
  showToast(`حالت «${tab.textContent}» انتخاب شد`);
}));

document.querySelectorAll('.heart').forEach(btn=>btn.addEventListener('click',e=>{
  e.preventDefault();btn.classList.toggle('saved');btn.textContent=btn.classList.contains('saved')?'♥':'♡';
  showToast(btn.classList.contains('saved')?'ملک به علاقه‌مندی‌ها اضافه شد':'ملک از علاقه‌مندی‌ها حذف شد');
}));

document.getElementById('searchSubmit').addEventListener('click',()=>{
  const values=[...document.querySelectorAll('.select-field select')].map(s=>s.value);
  showToast(`جستجو با ${values.filter(v=>v!=='همه' && !v.includes('همه')).join('، ') || 'همه فیلترها'} انجام شد`);
});

document.getElementById('advancedBtn').addEventListener('click',()=>showToast('فیلترهای پیشرفته به‌زودی فعال می‌شوند'));

document.getElementById('toTop').addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));

const menu=document.querySelector('.menu-btn');
const navLinks=document.querySelector('.nav-links');
menu.addEventListener('click',()=>{
  const open=menu.getAttribute('aria-expanded')==='true';
  menu.setAttribute('aria-expanded',String(!open));
  navLinks.classList.toggle('mobile-open',!open);
});

document.querySelectorAll('.nav-links a').forEach(a=>a.addEventListener('click',()=>{
  navLinks.classList.remove('mobile-open');menu.setAttribute('aria-expanded','false');
}));

const style=document.createElement('style');
style.textContent=`@media(max-width:820px){.nav-links.mobile-open{display:flex;position:absolute;top:68px;right:0;left:0;flex-direction:column;align-items:stretch;gap:0;background:rgba(18,24,29,.98);padding:8px 18px;border:1px solid rgba(255,255,255,.14);border-radius:12px;box-shadow:0 15px 35px rgba(0,0,0,.25)}.nav-links.mobile-open a{padding:11px;border-bottom:1px solid rgba(255,255,255,.08)}}`;
document.head.appendChild(style);

const sections=[...document.querySelectorAll('main section[id],header[id]')];
const links=[...document.querySelectorAll('.nav-links a')];
const observer=new IntersectionObserver(entries=>entries.forEach(entry=>{
  if(entry.isIntersecting){links.forEach(l=>l.classList.toggle('active',l.getAttribute('href')===`#${entry.target.id}`))}
}),{rootMargin:'-45% 0px -45% 0px',threshold:0});
sections.forEach(section=>observer.observe(section));
