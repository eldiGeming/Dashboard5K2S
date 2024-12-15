<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5K2S</title>
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png'); ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;  
      font-family: Raleway, sans-serif;
    }

    body {
      background: linear-gradient(90deg, #C7C5F4, #776BCC);
      overflow: hidden; /* Mencegah scrolling */
      width: 100vw;
      height: 100vh;
    }

    .container {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .screen {    
      background: linear-gradient(90deg, #5D54A4, #7C78B8);    
      position: relative;  
      height: 720px;
      width: 432px;  
      box-shadow: 0px 0px 30px #5C5696;
      transform: scale(0.64); /* Mengurangi ukuran keseluruhan 20% dari sebelumnya */
    }

    .screen_white {
      background: white;   
      position: relative;
      margin-left: -180px;  
      height: 720px;
      width: 550px;  
      box-shadow: 0px 0px 30px #5C5696;
      transform: scale(0.64); /* Mengurangi ukuran keseluruhan 20% dari sebelumnya */
    }

    /*Wave Animation*/
    ::selection{background-color: salmon; color: white;}
    .parallax > use{
      animation:move-forever 12s linear infinite;
      &:nth-child(1){animation-delay:-2s;}
      &:nth-child(2){animation-delay:-2s; animation-duration:5s}
      &:nth-child(3){animation-delay:-4s; animation-duration:3s}
    }

    @keyframes move-forever{
      0%{transform: translate(-90px , 0%)}
      100%{transform: translate(85px , 0%)} 
    }

    .editorial {
      display: block;
      width: 100%;
      height: 10em;
      max-height: 100vh;
      margin: 0;
      position: absolute; 
      bottom: 0;  
    }



    .ball {
        width: 100px;
        height: 100px;
        margin-left: 180px;
        background-color: #7E7BB9;
        border-radius: 50%;
        position: absolute;
        bottom: 0;  
        animation: bounce 3s infinite alternate;
    }

    @keyframes bounce {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-200px);
        }
    }

    /*prevent many large-by-comparison ripples by shrinking the height*/
    @media (max-width:50em){
      .content h1{font-size: 12vmax}
      .editorial{height:17vw;}
    }



    .screen__content {
      z-index: 1;
      position: relative;  
      height: 100%;
    }

    .screen__background {    
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 0;
      -webkit-clip-path: inset(0 0 0 0);
      clip-path: inset(0 0 0 0);  
    }

    .screen__background__shape {
      transform: rotate(45deg);
      position: absolute;
    }

    .screen__background__shape1 {
      height: 624px;
      width: 624px;
      background: #FFF;  
      top: -60px;
      right: 144px;  
      border-radius: 0 86px 0 0;
    }

    .screen__background__shape2 {
      height: 264px;
      width: 264px;
      background: #6C63AC;  
      top: -206px;
      right: 0;  
      border-radius: 38px;
    }

    .screen__background__shape3 {
      height: 648px;
      width: 228px;
      background: linear-gradient(270deg, #5D54A4, #6A679E);
      top: -28px;
      right: 0;  
      border-radius: 38px;
    }

    .screen__background__shape4 {
      height: 480px;
      width: 240px;
      background: #7E7BB9;  
      top: 504px;
      right: 60px;  
      border-radius: 72px;
    }

    .login {
      width: 384px;
      padding: 36px;
      padding-top: 187px;
    }

    .login__field {
      padding: 24px 0px;  
      position: relative;  
    }

    .login__icon {
      position: absolute;
      top: 36px;
      color: #7875B5;
      font-size: 22px;
    }

    .login__input {
      border: none;
      border-bottom: 2px solid #D1D1D4;
      background: transparent;
      padding: 12px;
      padding-left: 28px;
      font-weight: 700;
      width: 80%;
      font-size: 18px;
      transition: .2s;
    }

    .login__input:active,
    .login__input:focus,
    .login__input:hover {
      outline: none;
      border-bottom-color: #6A679E;
    }

    .login__input.invalid {
      border-bottom-color: red;
    }

    .login__submit {
      background: #fff;
      font-size: 16px;
      margin-top: 192px;
      padding: 19px 24px;
      border-radius: 32px;
      border: 1px solid #D4D3E8;
      text-transform: uppercase;
      font-weight: 700;
      display: flex;
      align-items: center;
      width: 100%;
      color: #4C489D;
      box-shadow: 0px 3px 3px #5C5696;
      cursor: pointer;
      transition: .2s;
    }

    .login__submit:active,
    .login__submit:focus,
    .login__submit:hover {
      border-color: #6A679E;
      outline: none;
    }

    .button__icon {
      font-size: 28px;
      margin-left: auto;
      color: #7875B5;
    }

    #title-form {
            color: #5C5696;
            font-family: 'Poppins';
            font-size: 104px; /* Menambahkan ukuran font jika diperlukan */
            font-weight: 600; /* Menggunakan gaya bold */
            margin-left: 20px;
    }

    #subtitle-form {
            color: #5C5696;
            font-family: 'Poppins';
            font-size: 84px; /* Menambahkan ukuran font jika diperlukan */
            font-weight: 600; /* Menggunakan gaya bold */
            margin-left: 20px;
            margin-top: -20px;
    }
  </style>
</head>
<body>
  <div class="container">
    
    <div class="screen">
      <div class="screen__content">
        <form class="login" id="loginForm" action="<?= base_url('login/authenticate') ?>" method="POST">
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input type="text" name="username" id="username" class="login__input" placeholder="Username">
          </div>
          <div class="login__field">
            <i class="login__icon fas fa-lock"></i>
            <input type="password" name="password" id="password" class="login__input password-field" placeholder="Password">
          </div>
          <button type="submit" class="button login__submit">
            <span class="button__text">Log In</span>
            <i class="button__icon fas fa-chevron-right"></i>
          </button>
        </form>
      </div>
      <div class="screen__background">
        <span class="screen__background__shape screen__background__shape4"></span>
        <span class="screen__background__shape screen__background__shape3"></span>
        <span class="screen__background__shape screen__background__shape2"></span>
        <span class="screen__background__shape screen__background__shape1"></span>
      </div>    
    </div>

    <div class="screen_white">
    <div id="title-form">5K2S</div>
    <div class="ball"></div>
      <svg class="editorial"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          viewBox="0 24 150 28"
          preserveAspectRatio="none">
      <defs>
      <path id="gentle-wave"
      d="M-160 44c30 0 
          58-18 88-18s
          58 18 88 18 
          58-18 88-18 
          58 18 88 18
          v44h-352z" />
        </defs>
        <g class="parallax">
        <use xlink:href="#gentle-wave" x="50" y="0" fill="#6A679E"/>
        <use xlink:href="#gentle-wave" x="50" y="3" fill="#7E7BB9"/>
        <use xlink:href="#gentle-wave" x="50" y="6" fill="#6C63AC"/>  
        </g>
      </svg>
  
    </div>
  </div>

</body>
<script>
  const form = document.getElementById('loginForm');
  const usernameInput = document.getElementById('username');
  const passwordInput = document.getElementById('password');
  const showPasswordIcon = document.querySelector('.show-password');

  passwordInput.addEventListener('mouseover', function () {
    passwordInput.type = 'text'; // Tampilkan password
  });

  passwordInput.addEventListener('mouseout', function () {
    passwordInput.type = 'password'; // Sembunyikan password
  });

  form.addEventListener('submit', function(event) {
    let isValid = true;

    if (usernameInput.value.trim() === '') {
      usernameInput.classList.add('invalid');
      isValid = false;
    } else {
      usernameInput.classList.remove('invalid');
    }

    if (passwordInput.value.trim() === '') {
      passwordInput.classList.add('invalid');
      isValid = false;
    } else {
      passwordInput.classList.remove('invalid');
    }

    if (!isValid) {
      event.preventDefault(); // Mencegah form submit jika ada field kosong
    }

  });
  
</script>
</html>
