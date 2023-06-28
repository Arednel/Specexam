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
                <label class="form-item__title">{{ __('Пароль') }}</label>
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
                <label class="form-item__title">{{ __('Образовательное учреждение') }}</label>
                <div class="form-item__input">
                    <select name="educational_institution" id="educational_institution"
                        class="educational-institution-select" required>
                        <optgroup label="{{ __('Бакалавриат') }}">
                        <optgroup label="&nbsp&nbsp&nbsp&nbsp {{ __('Школа') }}">
                            <option value="Бакалавриат - Школа - Иностранный гражданин">
                                {{ __('Иностранный гражданин') }}</option>
                            <option value="Бакалавриат - Школа - После армии">{{ __('После армии') }}</option>
                        </optgroup>
                        <optgroup label="&nbsp&nbsp&nbsp&nbsp {{ __('Колледж') }}">
                            <option value="Бакалавриат - Колледж - Иностранный гражданин">
                                {{ __('Иностранный гражданин') }}</option>
                            <option value="Бакалавриат - Колледж - Гражданин РК">{{ __('Гражданин РК') }}</option>
                            <option value="Бакалавриат - Колледж - После армии">{{ __('После армии') }}</option>
                        </optgroup>
                        <optgroup label="&nbsp&nbsp&nbsp&nbsp {{ __('ВУЗ') }}">
                            <option value="Бакалавриат - ВУЗ - Иностранный гражданин">{{ __('Иностранный гражданин') }}
                            </option>
                            <option value="Бакалавриат - ВУЗ - Гражданин РК">{{ __('Гражданин РК') }}</option>
                            <option value="Бакалавриат - ВУЗ - После армии">{{ __('После армии') }}</option>
                        </optgroup>
                        </optgroup>

                        <optgroup label="{{ __('Магистратура') }}">
                        <optgroup label="&nbsp&nbsp&nbsp&nbsp {{ __('ВУЗ') }}">
                            <option value="Магистратура - ВУЗ - Иностранный гражданин">
                                {{ __('Иностранный гражданин') }}</option>
                            <option value="Магистратура - ВУЗ - После армии">{{ __('После армии') }}</option>
                        </optgroup>
                        </optgroup>
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
                <label class="form-item__title">{{ __('Специальность') }}</label>
                <div class="form-item__input">
                    <select class="js-choice" name="speciality" id="speciality" required>
                        <option value="" disabled>{{ __('Выберите специальность') }}
                            @foreach ($specialities as $speciality)
                        <option value="{{ $speciality->gop }} {{ $speciality->ru }}">
                            {{ $speciality->gop }} - {{ $speciality->$locale }}
                        </option>
                        @endforeach
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
                <label class="form-item__title">{{ __('Язык') }}</label>
                <div class="form-item__input">
                    <select class="js-choice" name="locale" id="locale" required>
                        <option value="" disabled>
                            {{ __('Выберите предпочитаемый язык для прохождения теста') }}
                        </option>
                        <option value="{{ __('lang_first') }}">{{ __('lang_first_text') }}</option>
                        <option value="{{ __('lang_second') }}">{{ __('lang_second_text') }}</option>
                        <option value="{{ __('lang_third') }}">{{ __('lang_third_text') }}</option>
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
        shouldSort: false,
    })

    const choices_locale = new Choices('#locale', {
        searchEnabled: true,
        itemSelectText: '',
    })
</script>

</html>
