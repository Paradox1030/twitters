<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <style>
        html, body {
            background-color: #fff;
            background-image: radial-gradient(circle, #fff, #fff, #ddd);
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {

        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .title {
            font-size: 84px;
        }

        .users {
            font-size: 14px;
        }

        .users-list {
            font-size: 12px;
            list-style: none;
            padding: 0;
        }

        .users-list li {
            display: inline-block;
            padding-left: 10px;
        }

        .links > a {
            color: #252e37;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .wrapper-twitters {
            max-width: 1280px;
            max-height: 400px;
            overflow: scroll;
            padding: 1.5em;
        }

        table tr td{
            padding: 1em;
            border-bottom: 1px solid;
        }

        form#addTwit {
            display: flex;
            flex-direction: column;
            padding: 2em;
        }
    </style>
    <!-- Styles -->

    <script>
        $(function () {

            $('#addTwit').on('submit', function (e) {
                e.preventDefault();
                var categoryId = $('#categoryId').val();

                var userName = $('#userName').val();
                var content = $('#content').val();

                $.ajax({
                    url: '/twit/inserts',
                    type: "GET",
                    data: {categoryId: categoryId, userName: userName, content: content},
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.result == true) {
                            $('#content').val('');
                        } else {
                            alert('Заполните поля');
                        }
                    },

                    error: function (msg) {
                        alert('Ошибка');
                    }
                });
            });

            function reloadMsg() {
                $.ajax({
                    url: '/twit/get',
                    type: "GET",
                    data: {},
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.result.length > 0) {
                            $('.twitters tbody').html('')
                            let result = JSON.parse(JSON.stringify(data));

                            result.result.forEach(item => {
                                let tr = document.createElement('tr');
                                let tdCategory = document.createElement('td');
                                let tdUserName = document.createElement('td');
                                let tdContent = document.createElement('td');
                                let tdCreated = document.createElement('td');

                                tdCategory.innerHTML = item.title;
                                tdUserName.innerHTML = item.userName;
                                tdContent.innerHTML = item.content;
                                tdCreated.innerHTML = item.created_at;

                                tr.append(tdCategory)
                                tr.append(tdUserName)
                                tr.append(tdContent)
                                tr.append(tdCreated)


                                $('.twitters tbody').append(tr)
                            })

                        }
                    },

                    error: function (msg) {
                        alert('Ошибка');
                    }
                });
            }

            setInterval(reloadMsg, 3000);
        });


    </script>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="wrapper-twitters">
            <table class="twitters">
                <thead>
                <tr>
                <td>Категория</td>
                <td>Пользователь</td>
                <td>Контент</td>
                <td>Дата создания</td>
                </tr>
                </thead>
                <tbody>
                @foreach($twitters as $twit)
                    <tr>
                        <td>{{ $twit->title }}</td>
                        <td>{{ $twit->userName }}</td>
                        <td>{{ $twit->content }}</td>
                        <td>{{ $twit->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <form action="/twit/inserts" id="addTwit">
            <select name="categoryId" id="categoryId">
                @foreach($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                @endforeach
            </select>
            <input type="hidden" name="userName" value="admin" id="userName">
            <textarea name="content" cols="30" rows="10" id="content"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>
</div>
<?php phpinfo()?>
</body>
</html>
