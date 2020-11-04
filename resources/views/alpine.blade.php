<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alpine JS Testing page</title>
    <script src="{{asset('js/app.js')}}" defer></script>

</head>

<body>


<div x-data="{ first: 0, second: 0 }">
    <input type="text" x-model.number="first"> + <input type="text" x-model.number="second"> = <output x-text="first + second"></output>
</div>

</body>

</html>
