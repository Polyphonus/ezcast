<?php
//Gets renderers info and return it (should be a function)
function index($param = array())
{
    global $input;
	if (!session_key_check($input['sesskey'])) {
        echo "Usage: Session key is not valid";
        die;
    }

    if (!file_exists('../commons/renderers.inc')) {
        $renderers = array();
    } else {
        $renderers = require_once '../commons/renderers.inc';
    }

    require_once template_getpath('div_main_header.php');
    require_once template_getpath('div_list_renderers.php');
    require_once template_getpath('div_main_footer.php');
}
