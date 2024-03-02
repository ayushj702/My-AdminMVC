<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/src/View/style.css">
</head>
<body>

<div class="nav">
        <div class="logo">
            <p><a href="/">My-Admin</a></p>
        </div>

        <div class="right-links">
            <a href="/logout"> <button class="btn">Logout</button></a>
        </div>
    </div>

    <div class="container">
        <div class="box form-box">
            <header>Edit your Profile</header>
            <form action="/edit" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="">
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" value="">
                </div>
                
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
