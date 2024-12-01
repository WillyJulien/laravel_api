<?php

if ( !function_exists( 'public_data' ) ) {
    function public_data( $key, $default = null )
 {
        return config( 'public_site_data.' . $key, $default );
    }
}