<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<h1>Articles</h1>
<table>
    <tr>
        <th>#</th>
        <th>URL</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($articles as $article) : ?>
    <tr>
        <td><?= $i++; ?></td>
        <td><a href="<?= $article->url; ?>" target="_blank"><?= $article->url; ?></a></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
