<?php
    declare(strict_types=1);

    class Utils{
        public static function isVoidString(string $string): bool
        {
            if(empty($string))
                return true;

            $len = strlen($string);
            $cont = 0;

            for($i=0; $i<$len; $i++)
            {
                if($string[$i] == ' ')
                    $cont++;  
            }

            if($cont == $len)
                return true;
            else
                return false;
        }
    }
?>