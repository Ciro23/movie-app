<?php

namespace App\Libraries;

class ViewCells {

    public function header($params) {
        return view("view_cells/header", $params);
    }

    public function footer($params) {
        return view("view_cells/footer", $params);
    }
}
