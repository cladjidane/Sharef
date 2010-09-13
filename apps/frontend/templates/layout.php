<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <link rel="stylesheet" type="text/css" media="screen" href="/css/jQuery.treeTable.css" />
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/jquery.treeTable.js"></script>


    </head>
    <body>
        <h1>Sharef - Fabien CANU</h1>
        <div id="menu">
            <ul>
                <li>
                    <a href="<?php echo url_for('@ressources_index') ?>">Ressources</a>
                    <a href="<?php echo url_for('@category_index') ?>">Catégories</a>
                </li>
            </ul>
        </div>
        <?php echo $sf_content ?>
    </body>
</html>
