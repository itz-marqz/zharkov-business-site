<header>
  <div class="d-flex flex-wrap">
    <div class="logo-block" data-aos="fade-zoom-in" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-duration="600">
      <a href="/">
        <img src="/frontend/img/logo.png" alt="Logo">
      </a>
    </div>
    <div class="line nav">
      <ul class="nav-inline">
        <li data-aos="zoom-in-left" data-aos-duration="1200"><a href="/corporate-trainings">Корпоративні тренінги</a></li>
        <li data-aos="zoom-in-left" data-aos-duration="1400"><a href="/coaching">Коучинг</a></li>
        <li data-aos="zoom-in-left" data-aos-duration="1600"><a href="/open-trainings">Відкриті тренінги</a></li>
      </ul>
      <div class="messeges">
        <a href="javascript:void(0)" class="parent"><span class="icon"><img src="/frontend/img/icons/messages.png" alt="messages"></span></a>
        <a href="{{$settings->telegram}}" class="sibling-left"><span class="icon"><i class="fab fa-telegram-plane"></i></span></a>
        <a href="tel:{{$settings->phone}}" class="sibling-center"><span class="icon"><img src="/frontend/img/icons/cell.png" alt="cell"></span></a>
        <a href="{{$settings->whatsapp}}" class="sibling-rigth"><span class="icon"><i class="fab fa-whatsapp"></i></span></a>
      </div>
      <a href="tel:380508888887" class="service-el" data-aos="fade-zoom-in" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-duration="600"><span class="icon"><img src="/frontend/img/icons/phone.png" alt="Phone"></span><span class="title">{{$settings->phone}}</span></a>
      <ul class="bars">
        <li>
          <a href="javascript:void(0)"><span class="icon"><img src="/frontend/img/icons/bars.png" alt="bars"></span></a>
          <ul class="">
            <li><a href="/corporate-trainings">Корпоративні тренінги</a></li>
            <li><a href="/coaching">Коучинг</a></li>
            <li><a href="/open-trainings">Відкриті тренінги</a></li>
            <li><a href="/events">Заходи</a></li>
            <li><a href="/cases">Кейси</a></li>
            <li><a href="/reviews">Відгуки</a></li>
            <li><a href="/counseling">Консультування</a></li>
            <li><a href="/video">Відео</a></li>
            <li><a href="/poleznoe">Корисне</a></li>
            <li><a href="/contacts">Контакти</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="line line-md nav">
      <ul>
        <li><a href="/business-coaching">Про мене</a></li>
        <li><a href="/open-trainings">Відкриті тренінги</a></li>
        <li><a href="/corporate-trainings">Корпоративні тренінги</a></li>
      </ul>

      <a href="mailto:{{$settings->email}}" class="service-el"><span class="icon"><img src="/frontend/img/icons/mail.png" alt=""></span><span class="title">{{$settings->email}}</span></a>
      <a href="tel:{{$settings->phone}}" class="service-el"><span class="icon"><img src="/frontend/img/icons/phone.png" alt=""></span><span class="title">{{$settings->phone}}</span></a>
    </div>
  </div>
</header>
