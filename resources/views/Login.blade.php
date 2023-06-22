<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link rel="stylesheet" href={{ asset('css/reg.css') }}>
    <link rel="stylesheet" href={{ asset('css/input-anim.css') }}>
    <link rel="stylesheet" href={{ asset('css/fonts.css') }}>

    <title>{{ __('Войти') }}</title>
</head>

<body>
    <main>
        <form method="POST" action="/Login" class="form">

            @csrf

            <h1 class="form__title" style="margin-bottom: 6px;">{{ __('Добро пожаловать!') }} 👋</h1>

            <p class="form__subtitle">{{ __('Пожалуйста, войдите в свою учетную запись или зарегистрируйтесь') }} </p>

            <div class="form-item">
                <label class="form-item__title">Email</label>
                <div class="form-item__input">
                    <input type="email" placeholder="{{ __('Введите Email') }}" value="{{ old('email') }}"
                        name="email" autocomplete="email" required>
                    <span class="focus-input-1"></span>
                    <span class="focus-input-2"></span>
                </div>
                @error('email')
                    <div class="form-item__error show">
                        <p>{{ $message }}</p>
                    </div>
                @else
                    <div class="form-item__error"></div>
                @enderror
            </div>


            <div class="form-item">
                <label class="form-item__title">Password</label>
                <div class="form-item__input">
                    <input type="password" placeholder="{{ __('Введите пароль') }}" name="password"
                        autocomplete="current-password" required>
                    <span class="focus-input-1"></span>
                    <span class="focus-input-2"></span>
                </div>
                <div class="form-item__error" id='password_error'>
                    <p></p>
                </div>
            </div>

            <div class="form-item" style="display:flex; align-items:center; margin-bottom: 15px; gap:6px">
                <input type="checkbox">
                <label class="form-item__title" style="margin-bottom: 0;">{{ __('Запомнить меня') }}</label>
            </div>

            <button class="blue-btn form-item__btn" type="submit">{{ __('Войти (тест начнётся сразу)') }}</button>

            <div class="form__footer">
                <a href="/Register">{{ __('Зарегистрироваться') }}</a>
            </div>
        </form>
    </main>
</body>

</html>
