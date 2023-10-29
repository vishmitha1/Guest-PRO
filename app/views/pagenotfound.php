<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 404 page</title>
  <style>
    body {
      margin: 0;
      box-sizing: border-box;
    }

    .container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      background: linear-gradient(to right, rgba(0, 0, 0, .5), rgba(0, 0, 0, .1)), url('https://images.unsplash.com/photo-1595624871930-6e8537998592?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=871&q=80');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    h1 {
      font-size: 10rem;
      color: #fff;
      text-transform: uppercase;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    h2 {
      font-size: 2rem;
      color: #fff;
      text-transform: uppercase;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    p {
      font-size: 1.5rem;
      color: #fff;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    a {
      padding: 15px 20px;
      background: #52caee;
      font-size: 1rem;
      text-decoration: none;
      color: #333333;
      border-radius: .25rem;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.808)
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>404</h1>
    <h2>Page not found</h2>
    <p>The page you are looking for Under maintainence.</p>
    <p><a href="<?php echo URLROOT;?>/Home">Visit Homepage</a></p>
  </div>
</body>

</html>