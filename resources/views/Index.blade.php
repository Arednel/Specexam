<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <title>Pedexam</title>
</head>

<body>
    <header class="container">
        <div class="header__left">
            <div class="logo mob-hidden">
                <img src="{{ asset('img/logo.png') }}">
            </div>

            @can('admin')
                <button class="header__excel show" onclick="location.href='/ExcelExport'">{{ __('СКАЧАТЬ EXCEL') }}</button>
            @endcan
        </div>
        <div class="header__right">
            <button class="header__lang" target="_blank"
                onclick="location.href='/Language/{{ __('lang') }}'">KZ/RU</button>
        </div>
    </header>

    <main class="container">
        @if (session()->has('error'))
            <div class="popup-bg show" onclick="togglePopup()">
                <div class="popup">
                    <div class="popup__wrapper">
                        <h2 class="popup__title">
                            {{ auth()->user()->full_name }}
                        </h2>
                        {{-- Error text --}}
                        @switch(session('error'))
                            @case('exam completed')
                                <p class="popup__text">
                                    {{ __('Вы уже сдали специальный экзамен и получили «допуск» для поступления на педагогические специальности.') }}
                                </p>
                                <p class="popup__time">&nbsp;</p>
                            @break

                            @case('try later')
                                <p class="popup__text">
                                    {{ __('Вы уже прошли специальный экзамен сегодня и получили «недопуск». Вы можете повторно пройти экзамен через') }}
                                </p>
                                <p class="popup__time">{{ session('time_left') }}</p>
                            @break

                            @case('exam failed')
                                <p class="popup__text">
                                    {{ __('Вы уже прошли специальный экзамен два раза и получили «недопуск». Вы не можете повторно пройти специальный экзамен.') }}
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
                    {{ __('в университет, где') }}
                    <span><img src="{{ asset('img/icons/3.svg') }}" alt="icon"></span>
                    <br> {{ __('мечты') }}
                    <span><img src="{{ asset('img/icons/4.svg') }}" alt="icon"></span> {{ __('становятся') }} <br>
                    <span><img src="{{ asset('img/icons/5.svg') }}" alt="icon"></span> {{ __('реальностью!') }}
                </p>

                @if (auth()->user())
                    <button class="blue-btn intro__btn" onclick="location.href='/Login'">
                        {{ __('ПРОЙТИ ТЕСТ') }}
                    </button>
                @else
                    <button class="blue-btn intro__btn" onclick="location.href='/Register'">
                        {{ __('ПРОЙТИ ТЕСТ') }}
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
                    {{ __('Казахский национальный педагогический университет имени Абая является первым высшим учебным заведением в стране. Здесь работали такие великие сыны казахского народа, как Ахмет Байтурсынулы, Сакен Сейфуллин, Темирбек Жургенов, Мухтар Ауэзов, Малик Габдуллин, заложившие в казахстанском образовании высокие традиции духовности, патриотизма и верности учительскому делу.') }}
                </p>
                <p class="school__text info-text">
                    {{ __('По результатам статистического анализа в 2023 году профессия учителя вошла в тройку самых востребованных профессий в стране.') }}
                </p>
                <p class="applicants__text info-text">
                    {{ __('Сегодня Университет Абая, выпускающий квалифицированных педагогов по многим отраслям знаний и науки, является одним из динамично развивающихся высших учебных заведений Республики Казахстан. С гордостью могу сказать, что наш университет хорошо известен за рубежом – мы занимаем 76-е место в мире по уровню педагогического образования и входим в 100 лучших в мире вузов по английскому языку и литературе.') }}
                </p>
            </div>
        </div>

        <div class="applicants">
            <div class="applicants__content">
                <h2 class="applicants__title info-title">
                    {{ __('Приглашаем вас!') }}
                </h2>
                <p class="applicants__text info-text">
                    {{ __('Обучение в нашем университете имеет множество преимуществ:') }}
                </p>
                <ul class="applicants__text info-text">
                    <li>{{ __('Мы предлагаем практико-ориентированные академические программы.') }}
                    </li>
                    <li>{{ __('Мы имеем высоко квалифицированный преподавательский состав, среди которых есть академики, доктора и кандидаты наук.') }}
                    </li>
                    <li>{{ __('Наша молодежь ведет активную студенческую жизнь. Имеются научно-познавательные клубы, кружки и спортивные секции.') }}
                    </li>
                    <li>{{ __('Наш университет открывает большие возможности для студентов, желающих заниматься наукой.') }}
                    </li>
                    <li>{{ __('Кампус нашего университета расположен в историческом центре Алматы, являющегося одним из красивейших городов Казахстана.') }}
                    </li>
                    <li>{{ __('В Казахском национальном педагогическом университете имени Абая обучается более 16 000 студентов.') }}
                    </li>
                </ul>

                <p class="applicants__text info-text">
                    {{ __('Сегодня, выбрав наш университет, вы можете пополнить достойные ряды студентов КазНПУ имени Абая!') }}
                </p>
                <p class="applicants__text info-text">
                    {{ __('Нам нужна уверенная в своих знаниях талантливая и мотивированная молодежь, избравшая высокое служение детям и школе! Мы ждем вас, влюбленных в профессию учителя! Мы верим, что вы сможете поднять образование Казахстана до лучших мировых стандартов!') }}
                </p>
                <p class="applicants__text info-text">
                    {{ __('Университет Абая будет рад видеть вас и принять в свое дружное студенческое сообщество!') }}
                </p>
            </div>
            <div class="applicants__img mob-hidden">
                <img src="{{ asset('img/index3.png') }}" width="400" height="400">
            </div>
        </div>

        @if (auth()->user())
            <button class="blue-btn info-btn" onclick="location.href='/Login'">
                {{ __('ПРОЙТИ ТЕСТ') }}
            </button>
        @else
            <button class="blue-btn info-btn" onclick="location.href='/Register'">
                {{ __('ПРОЙТИ ТЕСТ') }}
            </button>
        @endif
    </main>
</body>

<script src="{{ asset('js/popup.js') }}"></script>

</html>
