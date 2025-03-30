<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>
    <ul>
        <li><a href="{{ route('users.index') }}">Manage Users</a></li>
        <li><a href="{{ route('orders.index') }}">Manage Orders</a></li>
    </ul>
</body>

</html>