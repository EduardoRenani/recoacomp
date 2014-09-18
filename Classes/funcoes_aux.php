<?php
/**
 * Created by Delton/Planeta ROODA/Clauser.
 * User: NUTED
 * Date: 28/08/14
 * Time: 15:04
 */

include_once("config/config.cfg");

    function gen_salt($length) {
        $alph = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $max = strlen($alph) - 1;
        $salt = '';
        for ($i = 0; $i < $length; $i++) {
            $salt .= substr($alph, rand(0,$max), 1);
        }
        return $salt;
    }


//This file contains the functions needed to use a email system.


//	uniqid() Can be useful, for instance, if you generate identifiers simultaneously on several hosts that might happen
//to generate the identifier at the same microsecond.
//With an empty prefix, the returned string will be 13 characters long. If more_entropy is TRUE, it will be 23 characters.
//	md5() Calculates the MD5 hash of str using the » RSA Data Security, Inc. MD5 Message-Digest Algorithm, and returns that hash.
//	substr('string',number<0). It starts from the end of the string, for instance: substr("name",-2) returns "me"
//		RETURNS A 20 CHARACTERS STRING
function newUniqueName ( $prefix = '', $suffix = '' ) {
    return $prefix.uniqid().substr( md5( uniqid( '', TRUE ) ), -7 ).$suffix;
}
//	empty() Determine whether a variable is considered to be empty. A variable is considered empty if it does not exist
//or if its value equals FALSE. empty() does not generate a warning if the variable does not exist.
//		RETURNS A 'TIME | DATE'
function formatTimestamp ( $timestamp = '' ) {
    //timestamp format : YYYY-MM-DD HH:MM:SS (= date( 'Y-m-d H:i:s' ))
    //DD/MM/YYYY às HH:MM:SS	: 'd/m/Y \à\s H:i:s'
    //HH:MM | DD/MM/YYYY		: 'H:i | d/m/Y'
    return empty( $timestamp ) ? date( 'H:i | d/m/Y' ) : date( 'H:i | d/m/Y', strtotime( $timestamp ) );
}

//	is_array() Finds whether the given variable is an array. Returns true or false.
//	array_keys() Gets the keys of the array.
//	array_filter() Returns the filtered array.
//	count() Counts all elements in an array, or something in an object.
//		RETURNS IF THE $var IS A ARRAY AND IF IT HAS AT LEAST 1 STRING STORED.
function is_assoc ( $var ) {
    return is_array( $var ) && ( bool )count( array_filter( array_keys( $var ), 'is_string' ) );
}

//	pathinfo() returns information about path: either an associative array or a string, depending on options.
//		RETURNS THE EXTENSION OF THE FILE IF IT HAS A VALID EXTENSION OR A EMPTY STRING IF IT DOESN'T.
//You should avoid the use this function directly. It's used inside other functions.
function getExtension ( $filename ) {
    $extension = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
    if ( $extension === '' ) {
        return '';
    } else {
        return '.'.$extension;
    }
}

//	in_array(mixed $needle , array $haystack) Returns TRUE if needle is found in the array, FALSE otherwise.
//		RETURNS THE FILE EXTENSION IF IT'S A VALID ONE OR A EMPTY STRING IF IT'S NOT.
function getAllowedExtension ( $filename ) {
    $file_extension = getExtension( $filename );

    $forbidden_extensions = array( '.bat', '.bin', '.cmd', '.com', '.dll', '.exe', '.lnk', '.msi', '.msp', '.ocx', '.pif', '.reg', '.scr', '.shb', '.vb', '.vbe', '.vbs', '.wsc', '.wsf', '.wsh' );

    if ( in_array( $file_extension, $forbidden_extensions ) === TRUE ) { //Extensão proibida!
        return '';
    } else {
        return $file_extension;
    }
}

//		RETURNS THE IMAGE EXTENSION IF IT'S A VALID ONE. OTHERWISE, IT RETURNS A EMPTY STRING.
function getImageExtension ( $filename ) {
    $file_extension = getExtension( $filename );

    $image_extensions = array( '.gif', '.png', '.jpg' );

    if ( in_array( $file_extension, $image_extensions ) === TRUE ) { //Extensão corresponde a uma imagem válida!
        return $file_extension;
    } else {
        return '';
    }
}


//	trim() returns a string with whitespace stripped from the beginning and end of str. (It also strip other things,
//see the entire list at http://php.net/manual/en/function.trim.php )
//	explode(string $delimiter , string $string [, int $limit ]) Returns an array of strings, each of which is a
//substring of string formed by splitting it on boundaries formed by the string delimiter.
//If limit is set and positive, the returned array will contain a maximum of limit elements
//with the last element containing the rest of string.
//		RETURNS IF THE NAME IS A VALID ONE. (true/false)
function validFullName ( $full_name ) {
    //Não é uma string
    if ( !is_string( $full_name ) )
        return FALSE;

    $full_name = trim( $full_name );

    //Nome está vazio
    if ( empty( $full_name ) )
        return FALSE;

    //Nome contém apenas um nome (não está completo)
    if ( count( explode( ' ', $full_name, 2 ) ) < 2 )
        return FALSE;

    return TRUE;
}

//		 RETURNS IF THE var $email CONTAINS A VALID EMAIL ADRESS. (true/false)
function validEmail ( $email ) {
    //Não é uma string
    if ( !is_string( $email ) ) {
        return FALSE;
    }

    $email = trim( $email );

    //Email está vazio
    if ( empty( $email ) ) {
        return FALSE;
    }

    //Email contém espaços
    if ( stripos( $email, ' ' ) !== FALSE ) {
        return FALSE;
    }

    //Email contém quantidade de '@' diferente de 1
    $email_exploded = explode( '@', $email, 3 );
    if ( count( $email_exploded ) != 2 ) {
        return FALSE;
    }

    //Email não contém '.' após o '@'
    $email_exploded_right = explode( '.', $email_exploded[1] );
    if ( count( $email_exploded_right ) < 2 ) {
        return FALSE;
    }

    //Email inconsistente após o '@' (contém '.' que não possui caracteres antes e depois)
    if ( in_array( '', $email_exploded_right ) === TRUE ) {
        return FALSE;
    }

    //Email inconsistente antes do '@' (contém '.' que não possui caracteres antes e depois)
    $email_exploded_left = explode( '.', $email_exploded[0] );
    if ( in_array( '', $email_exploded_left ) === TRUE ) {
        return FALSE;
    }

    return TRUE;
}

//	RETURNS HOW MANY ITEMS ARE LISTED INSIDE THE VAR $emailAttachmentString. THE ITEM SEPARATOR IS A ";"
function countEmailAttachments ( $emailAttachmentString ) {
    $emailAttachmentString = trim( $emailAttachmentString );
    if ( empty( $emailAttachmentString ) === TRUE ) {
        return 0;
    } else {
        return count( explode( ';', $emailAttachmentString ) );
    }
}

//	mail() Sends an email.
// bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )
//Os dados são esperados em UTF-8, por ser a codificação nativa do ETC
//		THIS FUNCTIONS IS THE ONE THAT ACTUALLY SENDS THE EMAIL.
function multi_attach_email ( $to, $subject, $message, $senderemail, $anexos = array() ) { // $anexos são do tipo $_FILES[]
    $random_hash	= md5( uniqid( '', TRUE ) );
    $mime_boundary	= "==Multipart_Boundary_x{$random_hash}x";

    $subject	= utf8_decode( $subject );
    $headers	= "From: ETC <".$senderemail.">\n".
        "MIME-Version: 1.0\n".
        "Content-Type: multipart/mixed;\n".
        " boundary=\"{$mime_boundary}\"";
    $message	= "--{$mime_boundary}\n".
        "Content-Type: text/html; charset=\"utf-8\"\n".
        "Content-Transfer-Encoding: 7bit\n\n".
        $message."\n\n";

    //$anexos é um array de arquivos do tipo de $_FILES[]
    for ( $i = 0; $i < count( $anexos ); $i++ ) {
        if ( is_file( $anexos[$i]['tmp_name'] ) ) {
            $fp			 = @fopen( $anexos[$i]['tmp_name'], 'rb' );
            $data		 = @fread( $fp, filesize($anexos[$i]['tmp_name'] ) );
            @fclose( $fp );
            $data		 = chunk_split( base64_encode( $data ) );
            $message	.= "--{$mime_boundary}\n".
                "Content-Type: application/octet-stream; name=\"".basename( $anexos[$i]['name'] )."\"\n".
                "Content-Description: ".basename( $anexos[$i]['name'] )."\n".
                "Content-Disposition: attachment;\n".
                "filename=\"".basename( $anexos[$i]['name'] )."\"; size=".filesize( $anexos[$i]['tmp_name'] ).";\n".
                "Content-Transfer-Encoding: base64\n\n".$data."\n\n";
        }
    }
    $message		.= "--{$mime_boundary}--";

    return mail( $to, $subject, $message, $headers, '-f'.$senderemail );
}
