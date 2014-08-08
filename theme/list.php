<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nested Navigations</title>
    <link rel="stylesheet" href="theme/css/demo.css">
    <link rel="stylesheet" href="theme/css/nestable.css">
</head>
<body>

    <h1>Nested Navigations</h1>
    <ul id="nav">
        <li><a href="#"  class="active">List Menus</a></li>
        <li><a href="<?php echo BASE_URL; ?>?page=create">Create New Menu</a></li>
    </ul>

    <ol class="breadcrumb">
        <li><a href="<?php echo BASE_URL; ?>">Nested Navigations</a></li>
        <li class="current"><a href="#">List Menus</a></li>
    </ol>

    <div id="content">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($db->count == 0) {
                        echo "<td align=center colspan=4 style='padding: 10px; font-size: 12px; '>No Menu found</td>";
                        return;
                    }
                    foreach ($menus as $menu) {
                        echo "<tr>
                            <td  style='width: 85px;'>{$menu['id']}</td>
                            <td>{$menu['name']}</td>
                            <td style='width: 125px;'>
                                <a href='".BASE_URL."?page=show&id={$menu['id']}'>Show</a> ::
                                <a href='".BASE_URL."?page=edit&id={$menu['id']}'>Edit</a> ::
                                <a href='".BASE_URL."?page=delete&id={$menu['id']}'>Remove</a>
                            </td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>


    <script src="vendor/jquery/jquery-1.11.1.min.js"></script>
    <script src="vendor/jquery/jquery.nestable.js"></script>
    <script>
        baseUrl = '<?php echo BASE_URL; ?>';
    </script>
    <script src="theme/js/main.js"></script>
</body>
</html>