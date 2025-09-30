<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product Notification</title>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>{{ $body }}</p>
    <a href="{{ route('products_details', $url) }}">{{ __('Read More') }}</a>
</body>

</html>
