const toast = document.getElementById('toast');
let toastTimer;
function showToast(message){
  if(!toast) return;
  toast.textContent=message;
  toast.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer=setTimeout(()=>toast.classList.remove('show'),2600);
}

/* تعامل تب‌های خرید، فروش، رهن و اجاره */
document.querySelectorAll('.tab').forEach(tab=>tab.addEventListener('click',()=>{
  document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
  tab.classList.add('active');
  showToast(`حالت «${tab.textContent}» انتخاب شد`);
}));

/* علاقه‌مندی‌ها */
document.querySelectorAll('.heart').forEach(btn=>btn.addEventListener('click',e=>{
  e.preventDefault();
  btn.classList.toggle('saved');
  btn.textContent=btn.classList.contains('saved')?'♥':'♡';
  showToast(btn.classList.contains('saved')?'ملک به علاقه‌مندی‌ها اضافه شد':'ملک از علاقه‌مندی‌ها حذف شد');
}));

/* جستجو */
const searchSubmit=document.getElementById('searchSubmit');
if(searchSubmit){
  searchSubmit.addEventListener('click',()=>{
    const values=[...document.querySelectorAll('.select-field select')].map(s=>s.value);
    showToast(`جستجو با ${values.filter(v=>v!=='همه' && !v.includes('همه')).join('، ') || 'همه فیلترها'} انجام شد`);
  });
}

/* جستجوی پیشرفته فعلاً غیرفعال است */
const advancedBtn=document.getElementById('advancedBtn');
if(advancedBtn){
  advancedBtn.disabled=true;
  advancedBtn.setAttribute('aria-disabled','true');
  advancedBtn.setAttribute('title','به‌زودی فعال می‌شود');
  advancedBtn.addEventListener('click',e=>e.preventDefault());
}

/* بازگشت به بالا */
const toTop=document.getElementById('toTop');
if(toTop) toTop.addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));

/* منوی موبایل */
const menu=document.querySelector('.menu-btn');
const navLinks=document.querySelector('.nav-links');
if(menu && navLinks){
  menu.addEventListener('click',()=>{
    const open=menu.getAttribute('aria-expanded')==='true';
    menu.setAttribute('aria-expanded',String(!open));
    navLinks.classList.toggle('mobile-open',!open);
  });

  document.querySelectorAll('.nav-links a').forEach(a=>a.addEventListener('click',()=>{
    navLinks.classList.remove('mobile-open');
    menu.setAttribute('aria-expanded','false');
  }));
}

/* استایل‌های تعاملی جدید؛ بدون تغییر ظاهر اصلی سایت */
const style=document.createElement('style');
style.textContent=`
  /* هاور آیتم‌های هدر */
  .nav-links a{
    transition:color .22s ease,transform .22s ease;
  }
  .nav-links a:hover,
  .nav-links a:focus-visible{
    color:#63ce70;
  }
  .nav-links a:not(.active):hover:after{
    content:'';
    position:absolute;
    right:0;
    left:0;
    bottom:0;
    height:2px;
    background:#63ce70;
    transform:scaleX(1);
  }

  /* ورود / ثبت‌نام */
  .login-btn{
    transition:background .22s ease,border-color .22s ease,color .22s ease,box-shadow .22s ease,transform .22s ease;
  }
  .login-btn:hover,
  .login-btn:focus-visible{
    background:#63ce70;
    border-color:#63ce70;
    color:#fff;
    box-shadow:0 7px 20px rgba(99,206,112,.25);
    transform:translateY(-2px);
  }
  .login-btn:hover svg,
  .login-btn:focus-visible svg{stroke:#fff}

  /* تب‌های خرید، فروش، رهن و اجاره */
  .tab{
    border-radius:9px;
    transition:color .22s ease,background .22s ease,transform .22s ease;
  }
  .tab:hover,
  .tab:focus-visible{
    color:#63ce70;
    background:rgba(99,206,112,.10);
  }
  .tab.active:hover{color:#63ce70}

  /* فیلترهای نوع ملک، محدوده، قیمت و متراژ */
  .search-row{
    gap:10px;
  }
  .select-field,
  .select-field:first-of-type,
  .select-field:last-of-type{
    border:1px solid rgba(255,255,255,.35);
    border-radius:12px;
    padding:10px 42px 8px 17px;
    box-shadow:0 3px 12px rgba(0,0,0,.06);
    transition:transform .22s ease,box-shadow .22s ease,border-color .22s ease,background .22s ease;
  }
  .select-field:hover,
  .select-field:focus-within{
    background:#fff;
    border-color:#63ce70;
    box-shadow:0 8px 22px rgba(99,206,112,.18);
    transform:translateY(-2px);
  }
  .select-field span{transition:color .22s ease}
  .select-field:hover span,
  .select-field:focus-within span{color:#43b953}
  .select-field b{transition:color .22s ease,transform .22s ease}
  .select-field:hover b,
  .select-field:focus-within b{
    color:#43b953;
    transform:translateY(1px);
  }

  /* دکمه جستجو */
  .search-submit{
    transition:transform .22s ease,box-shadow .22s ease,background .22s ease;
  }
  .search-submit:hover,
  .search-submit:focus-visible{
    background:#55c862;
    box-shadow:0 8px 22px rgba(97,201,107,.28);
    transform:translateY(-2px);
  }

  /* جستجوی پیشرفته فعلاً خاموش */
  .advanced:disabled{
    opacity:.45;
    cursor:not-allowed;
    pointer-events:none;
  }

  /* آیکون‌های اختصاصی دسته‌بندی‌ها */
  .cat-icon{
    width:38px;
    height:38px;
    display:grid;
    place-items:center;
    font-size:0;
    color:#55c763;
  }
  .cat-icon svg{
    width:34px;
    height:34px;
    fill:none;
    stroke:currentColor;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
    transition:transform .22s ease,filter .22s ease;
  }
  .category-strip a:hover .cat-icon svg{
    transform:translateY(-3px) scale(1.08);
    filter:drop-shadow(0 5px 7px rgba(67,185,83,.22));
  }

  @media(max-width:820px){
    .search-row{gap:7px}
    .select-field,
    .select-field:first-of-type,
    .select-field:last-of-type{border-radius:10px}
  }
`;
document.head.appendChild(style);

/* آیکون مرتبط برای هر دسته‌بندی */
const categoryIcons={
  'یک پروژه ساختمانی':`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V9l8-5 8 5v11"/><path d="M8 20v-5h8v5M9 10h.01M12 10h.01M15 10h.01"/><path d="M3 20h18"/></svg>`,
  'ملک تجاری':`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V8h16v12"/><path d="M7 8V4h10v4M7 12h2M11 12h2M15 12h2M7 16h2M11 16h2M15 16h2"/><path d="M3 20h18"/></svg>`,
  'زمین':`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 19h18M5 19l3-8 4 3 3-7 4 12"/><path d="M15 7c0-2 1.5-3.5 3.5-3.5S22 5 22 7c0 2.5-3.5 5-3.5 5S15 9.5 15 7Z"/></svg>`,
  'باغ':`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21V11"/><path d="M12 14c-4 0-6-2.2-6-5.5C9.5 8.5 12 10.5 12 14Z"/><path d="M12 12c0-3.8 2.3-6.2 6-6.5.2 3.7-1.9 6.5-6 6.5Z"/><path d="M5 21h14"/></svg>`,
  'ویلا':`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 11 9-7 9 7"/><path d="M5 10v10h14V10M9 20v-6h6v6"/><path d="M4 20h16"/></svg>`,
  'خانه و آپارتمان':`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 21V6h10v15M15 10h4v11M8 9h4M8 13h4M8 17h4M17 14h1M17 18h1"/><path d="M3 21h18"/></svg>`
};

document.querySelectorAll('.category-strip a').forEach(link=>{
  const label=link.querySelector('b')?.textContent.trim();
  const icon=link.querySelector('.cat-icon');
  if(icon && categoryIcons[label]) icon.innerHTML=categoryIcons[label];
});

/* فعال‌سازی لینک فعال هدر هنگام اسکرول */
const sections=[...document.querySelectorAll('main section[id],header[id]')];
const links=[...document.querySelectorAll('.nav-links a')];
if('IntersectionObserver' in window){
  const observer=new IntersectionObserver(entries=>entries.forEach(entry=>{
    if(entry.isIntersecting){
      links.forEach(l=>l.classList.toggle('active',l.getAttribute('href')===`#${entry.target.id}`));
    }
  }),{rootMargin:'-45% 0px -45% 0px',threshold:0});
  sections.forEach(section=>observer.observe(section));
}
