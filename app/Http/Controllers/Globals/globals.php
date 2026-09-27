<?php 
        $username = session()->get('username');

        $users = DB::select("SELECT * FROM `users` 
        JOIN user__permissions
        ON users.id = user__permissions.user_id
        JOIN permissions
        ON permissions.id = user__permissions.permission_id 
        WHERE users.email = '$username'");

        $menus = DB::select("SELECT * FROM `menus` 
        JOIN menu__permissions
        ON menu__permissions.menu_id = menus.id
        JOIN permissions
        ON permissions.id = menu__permissions.permission_id
        WHERE permissions.id = 1;");
?>