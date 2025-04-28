<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    @yield("style")
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
  @yield("content")


  <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
  @yield("script")
</body>

</html>
