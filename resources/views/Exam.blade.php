<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link rel="stylesheet" href={{ asset('css/reg.css') }}>
    <link rel="stylesheet" href={{ asset('css/testing.css') }}>
    <link rel="stylesheet" href={{ asset('css/fonts.css') }}>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <title>{{ __('Экзамен для абитуриентов') }}</title>
</head>

<body>
    <main>
        <form method="POST" action="/ExamEnd" id="exam_form" class="testing">

            @csrf

            <div class="testing-sidebar">
                <div class="testing-sidebar__head testing__head">
                    <button type="submit" class="blue-btn testing__btn">{{ __('Завершить') }}</button>
                </div>

                <div class="testing-sidebar__timebox">
                    <h2 class="testing-sidebar__title">{{ __('Оставшееся время') }} </h2>
                    <div class="testing-sidebar__time">
                        <p id="timer">00:00</p>
                    </div>
                </div>
            </div>

            <div class="testing-main">
                <div class="testing-main__head testing__head">
                    <p>{{ __('Экзамен для абитуриентов, поступающих на педагогические специальности') }} </p>
                </div>

                <div class="testing-main__content">
                    @foreach ($questions as $question)
                        <div class="question">

                            <div class="question__head">
                                <p class="question__title">{{ $question->$text }}</p>
                            </div>

                            <div class="questions">
                                <div class="questions__item">
                                    <input type="radio" name="question_answer_[{{ $question->id }}]"
                                        value="1"required>
                                    <label>
                                        {{ __('Да') }}
                                    </label>
                                </div>
                                <div class="questions__item">
                                    <input type="radio" name="question_answer_[{{ $question->id }}]" value="0"
                                        required>
                                    <label>{{ __('Нет') }}</label>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        </form>
    </main>
</body>

<script>
    $(document).ready(function() {
        $('.questions__item').each(function(e) {
            //On this (any questions__item) elememt click
            $(this).click(function(e) {
                //Check input inside this div
                $('input', this).prop("checked", true);
            });
        });
    });
</script>
<script src="{{ asset('js/easytimer.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var timer = new easytimer.Timer();

        //Settings timer
        timer.start({
            countdown: true,
            startValues: {
                seconds: {{ $time_left }}
            }
        });

        //At timer start 
        $('#timer').html(timer.getTimeValues().toString(['minutes', 'seconds']));

        //Do this every second
        timer.addEventListener('secondsUpdated', function(e) {
            //Update html (div)
            $('#timer').html(timer.getTimeValues().toString(['minutes', 'seconds']));
        });

        //When timer ends
        timer.addEventListener('targetAchieved', function(e) {
            $("#exam_form").submit();
        });
    });
</script>

</html>
