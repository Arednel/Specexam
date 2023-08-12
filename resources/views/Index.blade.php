<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <title>Specexam</title>
</head>

<body>
    <header class="container">
        <div class="header__left">
            <div class="logo mob-hidden">
                <img src="{{ asset('img/logo.png') }}">
            </div>

            @can('admin')
                <button class="header__excel" onclick="location.href='/ExcelExport'">{{ __('СКАЧАТЬ EXCEL') }}</button>
                <button class="header__excel" onclick="location.href='/Results'">Перейти к результатам</button>
            @endcan
        </div>

        <div class="header__right">
            <div class="dropdown">
                <button class="header__lang" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    {{ __('button_lang') }}
                    /
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-globe" viewBox="0 0 18 18">
                        <path
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                    </svg>
                </button>

                <ul class="dropdown-menu" aria-labelledby="Dropdown">
                    <li>
                        <a class="dropdown-item" href="Language/{{ __('first_lang_choose') }}">
                            <i class="flag-{{ __('first_flag') }} flag"></i>
                            {{ __('first_lang_full') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="Language/{{ __('second_lang_choose') }}">
                            <i class="flag-{{ __('second_flag') }} flag"></i>
                            {{ __('second_lang_full') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="Language/{{ __('third_lang_choose') }}">
                            <i class="flag-{{ __('third_flag') }} flag"></i>
                            {{ __('third_lang_full') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </header>

    <main class="container">
        @if (session()->has('error'))
            <div class="popup-bg show" onclick="togglePopup()">
                <div class="popup">
                    <div class="popup__wrapper">
                        @if (in_array(session('error'), ['exam completed', 'try later', 'exam failed']))
                            <h2 class="popup__title">
                                {{ auth()->user()->full_name }}
                            </h2>
                        @endif
                        {{-- Error text --}}
                        @switch(session('error'))
                            @case('exam completed')
                                <p class="popup__text">
                                    {{ __('Вы уже прошли собеседование и получили «допуск» для поступления на педагогические специальности.') }}
                                    <br><br>
                                    <button class="blue-btn go-to-sertificate"
                                        onclick="location.href='{{ session('PDF_link') }}'">
                                        {{ __('Перейти к сертификату') }}
                                    </button>
                                </p>
                                <p class="popup__time">&nbsp;</p>
                            @break

                            @case('try later')
                                <p class="popup__text">
                                    {{ __('Вы уже прошли собеседование сегодня и получили «недопуск». Вы можете повторно пройти собеседование через') }}
                                </p>
                                <p class="popup__time">{{ session('time_left') }}</p>
                            @break

                            @case('exam failed')
                                <p class="popup__text">
                                    {{ __('Вы уже прошли собеседование два раза и получили «недопуск». Вы не можете повторно пройти собеседование.') }}
                                </p>
                                <p class="popup__time">&nbsp;</p>
                            @break

                            @case('cant register')
                                <p class="popup__text">
                                    {{ __('Регистрация недоступна') }}
                                </p>
                                <p class="popup__time">&nbsp;</p>
                            @break

                            @case('cant start test')
                                <p class="popup__text">
                                    {{ __('Прохождения теста недоступно') }}
                                </p>
                                <p class="popup__time">&nbsp;</p>
                            @break
                        @endswitch

                    </div>
                </div>
            </div>
        @endif


        <div class="intro">
            <div class="intro__text">
                <p class="info-title">
                    {{ __('Добро пожаловать в') }}
                    <span><img src="{{ asset('img/icons/1.svg') }}" alt="icon"></span><br>
                    <span><img src="{{ asset('img/icons/2.svg') }}" alt="icon"></span>
                    {{ __('Abai University') }}
                    <span><img src="{{ asset('img/icons/3.svg') }}" alt="icon"></span>
                </p>

                @if (auth()->user())
                    @if (session()->has('error') && in_array(session('error'), ['exam completed', 'try later', 'exam failed']))
                        <button class="blue-btn intro__btn" onclick="location.href='{{ session('PDF_link') }}'">
                            {{ __('ПЕРЕЙТИ К СЕРТИФИКАТУ') }}
                        </button>
                    @else
                        <button class="blue-btn intro__btn" onclick="location.href='/Login'">
                            {{ __('ПРОЙТИ СОБЕСЕДОВАНИЕ') }}
                        </button>
                    @endif
                @else
                    <button class="blue-btn intro__btn" onclick="location.href='/Register'">
                        {{ __('ПРОЙТИ СОБЕСЕДОВАНИЕ') }}
                    </button>
                @endif
            </div>

            <div class="intro__img mob-hidden">
                <img src="{{ asset('img/index1.png') }}" width="494" height="632">
            </div>
        </div>

        <div class="school">
            <div class="school__img mob-hidden">
                <img src="{{ asset('img/index2.png') }}" width="480" height="420">
            </div>
            <div class="school__content">
                <h2 class="school__title info-title">
                    {{ __('Уважаемые Абитуриенты!') }}
                </h2>

                <p class="school__text info-text">
                    {{ __('КазНПУ имени Абая, реализующий образовательные программы высшего образования, приглашает Вас на платное обучение на основе тест-собеседования.') }}
                </p>
                <p class="school__text info-text">
                    {{ __('Собеседование могут пройти следующие категории граждан, поступающие:') }}
                </p>
                <p class="school__text info-text">
                    {{ __('В бакалавриат:') }}
                </p>
                <ul class="school__text info-text">
                    <li>
                        {{ __('- имеющие общее среднее, техническое и профессиональное образование, при условии соответствия с Классификатором родственных групп образовательных программ высшего образования и специальностей технического и профессионального, послесреднего образования для поступления в ВУЗ*') }}
                    </li>
                    <li>
                        {{ __('- имеющие высшее образование') }}
                    </li>
                    <li>
                        {{ __('- граждане Республики Казахстан имеющие общее среднее образование, техническое и профессиональное, послесреднее или высшее образование, отслужившие срочную воинскую службу в течение двух лет после прохождения срочной воинской службы в течение календарного года**') }}
                    </li>
                    <li>
                        {{ __('- иностранные граждане**') }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="applicants">
            <div class="applicants__content">
                <p class="applicants__text info-text">
                    {{ __('В магистратуру:') }}
                </p>
                <ul class="applicants__text info-text">
                    <li>
                        {{ __('- иностранные граждане**') }}
                    </li>
                    <li>
                        {{ __('- в профильную магистратуру граждане Республики Казахстан, отслужившие срочную воинскую службу в течение трех лет после прохождения срочной воинской службы**') }}
                    </li>
                </ul>
                <br>
                <p class="applicants__text info-text">
                    {{ __('*Приказ Министра образования и науки Республики Казахстан от 01.04.2019 года № 134 «Методические рекомендации соответствия родственных групп образовательных программ высшего образования и специальностей технического и профессионального, послесреднего образования» (Методическая рекомендация 134).') }}
                </p>
                <p class="applicants__text info-text">
                    <a
                        href="{{ __('http://www.testcenter.kz/ru/postupayushchim-v-vuz/ent/normativnye-dokumenty-ent/') }}">
                        {{ __('Подробнее') }}
                    </a>
                </p>
                <p class="applicants__text info-text">
                    {{ __('**При этом зачисление граждан, осуществляется в соответствии с академическим календарем за 5 (пять) дней до начала следующего академического периода.') }}
                </p>
            </div>
            <div class="applicants__img mob-hidden">
                <img src="{{ asset('img/index3.png') }}" width="400" height="400">
            </div>
        </div>

        @if (auth()->user())
            <button class="blue-btn info-btn" onclick="location.href='/Login'">
                {{ __('ПРОЙТИ СОБЕСЕДОВАНИЕ') }}
            </button>
        @else
            <button class="blue-btn info-btn" onclick="location.href='/Register'">
                {{ __('ПРОЙТИ СОБЕСЕДОВАНИЕ') }}
            </button>
        @endif
    </main>
</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
<script src="{{ asset('js/popup.js') }}"></script>

</html>
