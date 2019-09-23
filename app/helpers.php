<?php


function gravatars_url($email)
{

    $email = md5($email);

    return "https://gravatar.com/avatar/{{md5($email)}}?s=60";
}
