<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>보드</title>
</head>
<body>
    @include('layout.header')

    <main>
        <p>메인메인</p>
    </main>

    @include('layout.footer', ['key1' => '홍길동'])
</body>
</html>