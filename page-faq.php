<?php get_header(); ?>
<main class="melkino-extra-page melkino-faq-page">
  <div class="container">
    <section class="faq-hero">
      <div class="faq-hero-copy">
        <span class="faq-kicker"><span class="faq-kicker-dot"></span> راهنمای سریع ملکینو</span>
        <h1>سوالات متداول</h1>
        <p>پاسخ سریع و ساده به سوالات رایج شما درباره جستجو، ثبت و مدیریت ملک در ملکینو.</p>
      </div>
      <div class="faq-hero-stat" aria-hidden="true">
        <strong>۸</strong>
        <span>پاسخ به سوالات رایج</span>
      </div>
    </section>

    <section class="faq-layout">
      <div class="faq-intro">
        <span class="faq-eyebrow">هر آنچه لازم دارید</span>
        <h2>سریع جواب‌تان را پیدا کنید</h2>
        <p>روی هر سوال کلیک کنید تا پاسخ آن باز شود. پاسخ‌ها به‌صورت خلاصه و کاربردی آماده شده‌اند.</p>
        <div class="faq-help-card">
          <div class="faq-help-icon">؟</div>
          <div>
            <strong>جواب سوال‌تان اینجا نیست؟</strong>
            <span>تیم ملکینو آماده پاسخگویی به شماست.</span>
          </div>
          <a href="<?php echo esc_url(home_url('/contact')); ?>">تماس با ما <b>←</b></a>
        </div>
      </div>

      <div class="faq-list">
        <details open>
          <summary><span class="faq-number">۰۱</span><span>چطور می‌توانم ملک مورد نظرم را پیدا کنم؟</span></summary>
          <div class="faq-answer"><p>از بخش املاک می‌توانید بر اساس نوع ملک، منطقه، نوع معامله، قیمت، متراژ و تعداد خواب فیلتر کنید و گزینه مناسب خود را پیدا کنید.</p></div>
        </details>
        <details>
          <summary><span class="faq-number">۰۲</span><span>چطور ملک خودم را در ملکینو ثبت کنم؟</span></summary>
          <div class="faq-answer"><p>از گزینه «ثبت ملک» وارد فرم ثبت آگهی شوید، مشخصات ملک و تصاویر را وارد کنید و درخواست را ارسال کنید. آگهی پس از بررسی منتشر می‌شود.</p></div>
        </details>
        <details>
          <summary><span class="faq-number">۰۳</span><span>آیا ثبت ملک هزینه دارد؟</span></summary>
          <div class="faq-answer"><p>ثبت اولیه آگهی در ساختار فعلی سایت رایگان است و آگهی پیش از انتشار بررسی می‌شود.</p></div>
        </details>
        <details>
          <summary><span class="faq-number">۰۴</span><span>چقدر طول می‌کشد آگهی من بررسی شود؟</span></summary>
          <div class="faq-answer"><p>آگهی‌های ارسالی ابتدا در وضعیت بررسی قرار می‌گیرند و پس از بررسی مدیریت سایت، در صورت تأیید منتشر خواهند شد.</p></div>
        </details>
        <details>
          <summary><span class="faq-number">۰۵</span><span>آیا برای ثبت ملک باید حساب کاربری داشته باشم؟</span></summary>
          <div class="faq-answer"><p>بله. برای ثبت و مدیریت آگهی‌های خود باید وارد حساب کاربری شوید یا یک حساب جدید ایجاد کنید.</p></div>
        </details>
        <details>
          <summary><span class="faq-number">۰۶</span><span>چطور آگهی‌های ثبت‌شده خودم را مدیریت کنم؟</span></summary>
          <div class="faq-answer"><p>از بخش «حساب کاربری» می‌توانید آگهی‌های خود را مشاهده کنید و وضعیت آن‌ها را بررسی و مدیریت کنید.</p></div>
        </details>
        <details>
          <summary><span class="faq-number">۰۷</span><span>چطور با مشاور یک ملک تماس بگیرم؟</span></summary>
          <div class="faq-answer"><p>در صفحه ملک یا صفحه مشاور، اطلاعات تماس درج‌شده را مشاهده می‌کنید و می‌توانید از روش‌های ارتباطی موجود استفاده کنید.</p></div>
        </details>
        <details>
          <summary><span class="faq-number">۰۸</span><span>اگر سوال دیگری داشته باشم چه کار کنم؟</span></summary>
          <div class="faq-answer"><p>از صفحه «تماس با ما» پیام خود را برای تیم ملکینو ارسال کنید تا درخواست شما بررسی شود.</p></div>
        </details>
      </div>
    </section>
  </div>
</main>

<style>
.melkino-faq-page{direction:rtl;padding:42px 0 70px;background:linear-gradient(180deg,#f7faf8 0,#fff 42%,#f8faf9 100%);min-height:calc(100vh - 82px)}
.melkino-faq-page .container{width:min(1120px,calc(100% - 40px));margin-inline:auto}
.faq-hero{position:relative;overflow:hidden;display:flex;align-items:center;justify-content:space-between;gap:30px;padding:38px 48px;border-radius:24px;background:linear-gradient(135deg,#152a22,#213b30);color:#fff;box-shadow:0 22px 55px rgba(22,42,34,.17);isolation:isolate}
.faq-hero:before,.faq-hero:after{content:'';position:absolute;border-radius:50%;border:1px solid rgba(124,224,141,.14);z-index:-1}.faq-hero:before{width:360px;height:360px;left:-120px;top:-170px}.faq-hero:after{width:220px;height:220px;right:45%;bottom:-170px}
.faq-hero-copy{max-width:680px}.faq-kicker{display:inline-flex;align-items:center;gap:8px;padding:7px 12px;border:1px solid rgba(125,224,142,.2);border-radius:999px;background:rgba(100,207,115,.09);color:#a8edb2;font-size:11px;font-weight:700}.faq-kicker-dot{width:7px;height:7px;border-radius:50%;background:#69d679;box-shadow:0 0 0 5px rgba(105,214,121,.1)}
.faq-hero h1{margin:14px 0 6px;font-size:34px;line-height:1.35;font-weight:900}.faq-hero p{margin:0;color:#d0ddd5;font-size:13px;line-height:2}
.faq-hero-stat{flex:none;width:150px;height:150px;border:1px solid rgba(255,255,255,.11);border-radius:50%;background:radial-gradient(circle at 35% 30%,rgba(105,214,121,.28),rgba(255,255,255,.04) 65%);display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center}.faq-hero-stat strong{font-size:42px;line-height:1;color:#8ce49a;font-weight:900}.faq-hero-stat span{margin-top:7px;font-size:10px;color:#d7e3dc}
.faq-layout{display:grid;grid-template-columns:300px 1fr;gap:34px;align-items:start;margin-top:34px}.faq-intro{position:sticky;top:24px;padding:26px;border:1px solid #e5ece7;border-radius:20px;background:#fff;box-shadow:0 12px 35px rgba(27,42,34,.055)}.faq-eyebrow{color:#55bd66;font-size:11px;font-weight:800}.faq-intro h2{margin:8px 0;font-size:21px;line-height:1.6;font-weight:900;color:#25302b}.faq-intro>p{margin:0;color:#77817b;font-size:11px;line-height:2}
.faq-help-card{margin-top:22px;padding:16px;border-radius:15px;background:linear-gradient(135deg,#effaf1,#f8fcf8);border:1px solid #dcefe0}.faq-help-card{display:grid;grid-template-columns:34px 1fr;gap:9px;align-items:start}.faq-help-icon{grid-row:span 2;width:34px;height:34px;border-radius:10px;background:#58c96a;color:#fff;display:grid;place-items:center;font-size:20px;font-weight:800}.faq-help-card strong{font-size:11px;color:#314038}.faq-help-card span{font-size:10px;color:#78847d}.faq-help-card a{grid-column:1/-1;display:flex;justify-content:space-between;align-items:center;margin-top:5px;padding-top:10px;border-top:1px solid #dceee0;color:#44ad56;font-size:11px;font-weight:800}.faq-help-card a:hover{color:#218f38}.faq-help-card b{font-size:17px;line-height:1}
.faq-list{display:grid;grid-template-columns:1fr 1fr;gap:12px}.faq-list details{border:1px solid #e4eae6;border-radius:17px;background:#fff;overflow:hidden;box-shadow:0 6px 20px rgba(24,39,30,.035);transition:border-color .22s ease,box-shadow .22s ease,transform .22s ease}.faq-list details:hover{border-color:#cde9d2;box-shadow:0 10px 26px rgba(33,80,43,.07);transform:translateY(-2px)}.faq-list details[open]{grid-column:1/-1;border-color:#b9e5c1;box-shadow:0 14px 34px rgba(44,118,57,.09)}
.faq-list summary{list-style:none;display:flex;align-items:center;gap:12px;min-height:74px;padding:14px 18px;cursor:pointer;color:#27322d;font-size:12px;font-weight:800;line-height:1.9}.faq-list summary::-webkit-details-marker{display:none}.faq-list summary:after{content:'+';margin-right:auto;width:27px;height:27px;border-radius:9px;background:#f1f5f2;color:#5d6a63;display:grid;place-items:center;font-size:19px;font-weight:400;transition:transform .22s ease,background .22s ease,color .22s ease}.faq-list details[open] summary:after{content:'−';background:#58c96a;color:#fff}.faq-number{flex:none;width:31px;height:31px;border-radius:9px;background:#f1faf2;color:#54b963;display:grid;place-items:center;font-size:9px;font-weight:900}.faq-list details[open] .faq-number{background:#e0f6e3}.faq-answer{padding:0 61px 20px 58px;color:#68736c}.faq-answer p{margin:0;font-size:11px;line-height:2.15}
@media(max-width:850px){.faq-layout{grid-template-columns:1fr}.faq-intro{position:static}.faq-hero{padding:30px}.faq-list{grid-template-columns:1fr}.faq-list details[open]{grid-column:auto}}
@media(max-width:560px){.melkino-faq-page{padding:24px 0 45px}.melkino-faq-page .container{width:min(100% - 28px,600px)}.faq-hero{padding:26px 20px;border-radius:19px;align-items:flex-start}.faq-hero-stat{display:none}.faq-hero h1{font-size:27px}.faq-hero p{font-size:11px}.faq-layout{margin-top:20px;gap:18px}.faq-intro{padding:21px;border-radius:17px}.faq-list summary{min-height:68px;padding:12px 14px;font-size:11px;gap:9px}.faq-number{width:28px;height:28px}.faq-list summary:after{width:25px;height:25px;border-radius:8px}.faq-answer{padding:0 51px 17px 18px}.faq-help-card{margin-top:17px}}
</style>
<?php get_footer(); ?>
