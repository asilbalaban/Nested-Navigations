<?php

    $go = (!isset($_GET['page'])) ? 'home' : $_GET['page'];

    switch ($go) {
        case 'store':
            $data['structure']  = $_POST['structure'];
            $data['name']       = $_POST['name'];

            // if not an existing menu
            if (empty($_POST['id'])) {
                // then create new record

                $id = $db->insert('menus', $data);

                $return = array(
                        'status' => 'ok',
                        'message' => 'Success!',
                        'redirect' => BASE_URL . '?page=list'
                    );

                echo json_encode($return);

            } else {
                // then update the menu structure

                $db->where ("id", $_POST['id']);
                $db->update ('menus', $data);

                $return = array(
                        'status' => 'ok',
                        'message' => 'Success!',
                        'redirect' => BASE_URL . '?page=list'
                    );

                echo json_encode($return);
            }
            break;

        case 'show':
            $id = (int)$_GET['id'];
            $db->where ("id", $id);
            $menu = $db->getOne ("menus");
            include 'show.php';
            break;


        case 'edit':
            $id = (int)$_GET['id'];
            $db->where ("id", $id);
            $menu = $db->getOne ("menus");
            include 'edit.php';
            break;

        case 'delete':
            $id = (int)$_GET['id'];
            $db->where ("id", $id);
            $db->delete ('menus');
            header ("Location: ".BASE_URL.'?page=list');
            break;

        case 'create':
            include 'create.php';
            break;

        default:
            $menus = $db->get ("menus");
            include 'list.php';
            break;
    }