<?php

function customException($e)
{
    echo "Something Went Wrong".$e;
}


// set_error_handler('customException');