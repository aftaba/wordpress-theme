<?php
// This script used for downloadinf the PDF file.

if ( isset( $_GET['file'] ) ) {
	$file = $_GET['file'];
    $uploads_dir =  wp_upload_dir();
    // converting url in relative for checking if file exist or not.
    $relative_URL = str_replace( $uploads_dir["baseurl"], $uploads_dir["basedir"], $file );
    if ( file_exists( $relative_URL ) ) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename( $file ).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        readfile( $file );
        exit;
    }
}