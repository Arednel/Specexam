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

    <link rel="stylesheet" href='https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css'>

    <title>{{ __('Регистрация') }}</title>
</head>

<body>
    <main>
        <form method="POST" action="/Register" class="form">

            @csrf

            <h1 class="form__title">{{ __('Добро пожаловать!') }} 👋</h1>

            <div class="form-item">
                <label class="form-item__title">{{ __('Полное имя') }}</label>
                <div class="form-item__input">
                    <input type="text" placeholder="{{ __('ФИО') }}" value="{{ old('full_name') }}"
                        name="full_name" autocomplete="name" required>
                    <span class="focus-input-1"></span>
                    <span class="focus-input-2"></span>
                </div>

                @error('full_name')
                    <div class="form-item__error show">
                        <p>{{ $message }}</p>
                    </div>
                @else
                    <div class="form-item__error"></div>
                @enderror
            </div>

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
                        autocomplete="new-password" required>
                    <span class="focus-input-1"></span>
                    <span class="focus-input-2"></span>
                </div>
                <div class="form-item__error"></div>
            </div>


            <div class="form-item">
                <label class="form-item__title">{{ __('ИИН') }}</label>
                <div class="form-item__input">
                    <input type="number" value="{{ old('iin') }}" name="iin" required>
                    <span class="focus-input-1"></span>
                    <span class="focus-input-2"></span>
                </div>

                @error('iin')
                    <div class="form-item__error show">
                        <p>{{ $message }}</p>
                    </div>
                @else
                    <div class="form-item__error"></div>
                @enderror
            </div>

            <div class="form-item">
                <label class="form-item__title">{{ __('ИКТ') }}</label>
                <div class="form-item__input">
                    <input type="number" value="{{ old('ict') }}" name="ict" required>
                    <span class="focus-input-1"></span>
                    <span class="focus-input-2"></span>
                </div>

                @error('ict')
                    <div class="form-item__error show">
                        <p>{{ $message }}</p>
                    </div>
                @else
                    <div class="form-item__error"></div>
                @enderror
            </div>

            <div class="form-item">
                <label class="form-item__title">{{ __('Специальность') }}</label>
                <div class="form-item__input">
                    <select class="js-choice" name="speciality" id="speciality" required>
                        <option value="" disabled>{{ __('Выберите специальность') }}
                        <option value="В001 Педагогика и психология">{{ __('Педагогика и психология') }}</option>
                        <option value="В002 Дошкольное обучение и воспитание">
                            {{ __('Дошкольное обучение и воспитание') }}</option>
                        <option value="В003 Педагогика и методика начального обучения">
                            {{ __('Педагогика и методика начального обучения') }}</option>
                        <option value="В008 Подготовка учителей основы права и экономики">
                            {{ __('Подготовка учителей основы права и экономики') }}</option>
                        <option value="В009 Подготовка учителей математики">{{ __('Подготовка учителей математики') }}
                        </option>
                        <option value="В010 Подготовка учителей физики">{{ __('Подготовка учителей физики') }}</option>
                        <option value="В011 Подготовка учителей информатики">
                            {{ __('Подготовка учителей информатики') }}</option>
                        <option value="В012 Подготовка учителей химии">{{ __('Подготовка учителей химии') }}</option>
                        <option value="В013 Подготовка учителей биологии">{{ __('Подготовка учителей биологии') }}
                        </option>
                        <option value="В014 Подготовка учителей географии">{{ __('Подготовка учителей географии') }}
                        </option>
                        <option value="В015 Подготовка учителей по гуманитарным дисциплинам">
                            {{ __('Подготовка учителей по гуманитарным дисциплинам') }}</option>
                        <option value="В016 Подготовка учителей по казахскому языку и литературе">
                            {{ __('Подготовка учителей по казахскому языку и литературе') }}</option>
                        <option value="В017 Подготовка учителей по русскому языку и литературе">
                            {{ __('Подготовка учителей по русскому языку и литературе') }}</option>
                        <option value="В018 Подготовка учителей по иностранному языку">
                            {{ __('Подготовка учителей по иностранному языку') }}</option>
                        <option value="В019 Подготовка специалистов по социальной педагогике и самопознанию">
                            {{ __('Подготовка специалистов по социальной педагогике и самопознанию') }}</option>
                        <option value="В020 Специальная педагогика">{{ __('Специальная педагогика') }}</option>
                    </select>
                </div>

                @error('speciality')
                    <div class="form-item__error show">
                        <p>{{ $message }}</p>
                    </div>
                @else
                    <div class="form-item__error"></div>
                @enderror
            </div>

            <div class="form-item">
                <label class="form-item__title">{{ __('Образовательное учреждение') }}</label>
                <div class="form-item__input">
                    <select class="js-choice" name="educational_institution" id="educational_institution" required>
                        <option value="" disabled>
                            {{ __('Укажите своё последнее оконченное образовательное учреждение') }}
                        </option>
                        <option value="Школа">{{ __('Школа') }}</option>
                        <option value="Колледж">{{ __('Колледж') }}</option>
                    </select>
                </div>

                @error('educational_institution')
                    <div class="form-item__error show">
                        <p>{{ $message }}</p>
                    </div>
                @else
                    <div class="form-item__error"></div>
                @enderror
            </div>

            <div class="form-item">
                <label class="form-item__title">{{ __('Язык') }}</label>
                <div class="form-item__input">
                    <select class="js-choice" name="locale" id="locale" required>
                        <option value="" disabled>
                            {{ __('Выберите предпочитаемый язык для прохождения теста') }}
                        </option>
                        <option value="{{ __('lang_first') }}">{{ __('lang_first_text') }}</option>
                        <option value="{{ __('lang_second') }}">{{ __('lang_second_text') }}</option>
                    </select>
                </div>

                @error('locale')
                    <div class="form-item__error show">
                        <p>{{ $message }}</p>
                    </div>
                @else
                    <div class="form-item__error"></div>
                @enderror
            </div>

            <button class="blue-btn form-item__btn"
                type="submit">{{ __('Зарегистрироваться (тест начнётся сразу)') }}</button>

            <div class="form__footer">
                <p>{{ __('Уже есть аккаунт?') }} <a href="/Login">{{ __('Войти') }}</a></p>
            </div>
        </form>
    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
<script>
    const choices_speciality = new Choices('#speciality', {
        searchEnabled: true,
        itemSelectText: '',
    })

    const choices_educational_institution = new Choices('#educational_institution', {
        searchEnabled: false,
        itemSelectText: '',
    })

    const choices_locale = new Choices('#locale', {
        searchEnabled: true,
        itemSelectText: '',
    })
</script>

</html>
