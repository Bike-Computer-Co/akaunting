<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="/public{{ mix('/inertia/css/app.css') }}" rel="stylesheet" />
    <script src="/public{{ mix('/inertia/js/app.js') }}" defer></script>
    @routes
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
