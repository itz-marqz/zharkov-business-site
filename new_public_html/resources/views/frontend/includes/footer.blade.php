<footer>
  <div class="container-fluid fotter-lg">
    <div class="row">
      <div class="col-sm-4">
        <ul class="nav-block">
          <li><a href="/corporate-trainings">Корпоративні тренінги</a></li>
          <li><a href="/coaching">Коучинг</a></li>
          <li><a href="/open-trainings">Відкриті тренінги</a></li>
        </ul>
      </div>
      <div class="logo-block col-sm-4 align-self-center">
        <a href="/">
          <img src="/frontend/img/logo.png" alt="">
        </a>
      </div>
      <div class="col-sm-4">
        <ul class="nav-block t-right">
          <li><a href="/counseling">Консультування</a></li>
          <li><a href="mailto:{{$settings->email}}" class="service-el"><span class="icon"><img src="/frontend/img/icons/w-mail.png" alt=""></span><span class="title">{{$settings->email}}</span></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid footer-sm">
    <div class="row">
      <div class="logo-block col-4">
        <a href="/">
          <img src="/frontend/img/logo.png" alt="">
        </a>
      </div>
      <div class="col-8 align-self-center">
        <div class="messeges">
          <a href="https://www.facebook.com/profile.php?id=100000975226585" class="parent facebook">
            <span class="icon"><i class="fab fa-facebook-f"></i></span>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="line nav">
        <ul>
          <li><a href="/coaching">Коучинг</a></li>
          <li><a href="/#clients">Клієнти</a></li>
          <li><a href="/#feedback">Зворотній зв&amp;язок</a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="line nav">
        <ul>
          <li>
            <a href="mailto:{{$settings->email}}" class="service-el">
              <span class="icon">
                <img src="/frontend/img/icons/mail.png" alt="">
              </span>
              <span class="title">{{$settings->email}}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
