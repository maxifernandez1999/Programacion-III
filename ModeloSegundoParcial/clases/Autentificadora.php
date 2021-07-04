<?php
    use Firebase\JWT\JWT;
    class Autentificadora{
        public static function CrearJWT($data, $exp = (60*5)) : string
        {
            $time = time();
            //self::$aud = self::Aud();

            $token = array(
        	    'iat'=>$time,
                'exp' => $time + $exp,
                'data' => $data,
                'app'=> "API REST 2021"
        );

        return JWT::encode($token, "claveSecreta");
        }
    }

?>