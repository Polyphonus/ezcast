<?php

require_once(__DIR__ . '/../../commons/lib_ezmam.php');

function index($param = array())
{
    global $input;
    global $max_course_code_size;
    global $max_album_label_size;
    global $course_id_validation_regex;
    global $input_validation_regex;

    if (!session_key_check($input['sesskey'])) {
        echo "Usage: Session key is not valid";
        die;
    }

    if (isset($input['create']) && $input['create']) {
        $course_code_public = null;
        $course_name = null;


        if (isset($input['course_code'])){
            if (!check_validation_text($input['course_code'])){
                $error = template_get_message('error_validation_course_code', get_lang());

            } else {
                $course_code_public = htmlentities($input['course_code']);
                $id_course_input = preg_replace($course_id_validation_regex, "", $course_code_public); //start from the public code, keeping only alphabetic characters
                if (strlen($course_code_public) > $max_course_code_size){
                    $course_code_public = substr($course_code_public, 0, $max_course_code_size);
                }
            }
        }

        if (isset($input['course_name'])){
            if (!check_validation_text($input['course_name'])){
                $newError = template_get_message('error_validation_course_name', get_lang());
                if ($error) {
                    $error .= "<br>".$newError;
                } else {
                    $error = $newError;
                }
            
            } else {
                $course_name = htmlentities($input['course_name']);
                if (strlen($course_name) > $max_album_label_size)
                {
                    $course_name = substr($course_name, 0, $max_album_label_size);
                }
            }
        }

        $args_ok = false;
        if(empty($error))
        {
             if (empty($course_code_public)) {
                $error = template_get_message('missing_course_code', get_lang());
            } elseif (empty($course_name)) {
                $error = template_get_message('missing_course_name', get_lang());
            } else {
                $args_ok = true;
            }
        }

        if ($args_ok) {
            //generate real course id
            $course_id = ezmam_course_get_new_id($id_course_input);

            $in_recorders = isset($input['in_recorders']) ? '1' : '0';

            $valid = db_course_create($course_id, $course_code_public, $course_name, $in_recorders);
            if ($valid) {
                $input['course_code'] = $course_id;
                db_log(db_gettable('courses'), 'Created course ' . $input['course_code'], $_SESSION['user_login']);
                redirectToController('view_course_details');
                return;
            } else {
                //failure message ?
            }

            notify_changes();
        }
    }

    include template_getpath('div_main_header.php');
    include template_getpath('div_create_course.php');
    include template_getpath('div_main_footer.php');
}
