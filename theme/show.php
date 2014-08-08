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
        <li><a href="<?php echo BASE_URL; ?>?page=list">List Menus</a></li>
        <li><a href="<?php echo BASE_URL; ?>?page=create">Create New Menu</a></li>
    </ul>

    <ol class="breadcrumb">
        <li><a href="<?php echo BASE_URL; ?>">Nested Navigations</a></li>
        <li><a href="<?php echo BASE_URL; ?>?page=list">Show Menu</a></li>
        <li class="current"><a href="#"><?php echo $menu['name']; ?></a></li>
    </ol>

    <div id="content">
        <?php
            // PHP Function for showing unordered list

            function build($item)
            {
                if (!isset($ret)) $ret = '';

                $ret .= "<li><a href='".$item->url."'>".$item->text;

                if( isset($item->children) ) {
                    $ret .= "<ul>";
                    foreach($item->children as $children) {
                        $ret .= build($children);
                    };
                    $ret .= "</ul>";
                }

                $ret .= "</a></li>";
                return $ret;
            }

            function makeList($json)
            {
                $json = json_decode($json);

                $ret  = '<ul>';
                foreach($json as $item) {
                    $ret .= build($item);
                }
                $ret .= '</ul>';

                return $ret;
            }

            $list = makeList($menu['structure']);
            echo $list;
        ?>



        <textarea readonly><?php echo $list; ?></textarea>
        <a href="<?php echo BASE_URL; ?>?page=edit&id=<?php echo $menu['id']; ?>">Edit this menu</a>
    </div>


    <script src="vendor/jquery/jquery-1.11.1.min.js"></script>
    <script src="vendor/jquery/jquery.nestable.js"></script>
    <script>
        baseUrl = '<?php echo BASE_URL; ?>';
    </script>
    <script src="theme/js/main.js"></script>



</body>
</html>