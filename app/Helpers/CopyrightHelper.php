<?php

if ( ! function_exists('copyright')) {

    /**
     * description
     *
     * @param
     *
     * @return
     */
    function copyright()
    {
        $initYear        = 2021;
        $currYear        = date('Y');
        $orgName         = 'Asbury University';

        $yearArr = [$initYear, $currYear];
        sort($yearArr);

        $yearRange = (bool)($yearArr[1] - $yearArr[0]) ? $yearArr[0] . '-' . $yearArr[1] : $yearArr[0];

        return 'Copyright © ' . $yearRange . ' ' . $orgName . ' | All Rights Reserved.';
    }
}
