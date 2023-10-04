<html>
    <head>
    <title>CodeIgniter Tutorial</title>
    </head>
    <body>
        <h1>this is about home   </h1>
        <?php foreach($data['users'] as $user): ?>
            <p><?php echo $user->name; ?> - <?php echo $user->age; ?></p>
        <?php endforeach; ?>
    </body>
</html>