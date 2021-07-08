<?php
    use Firebase\JWT\JWT;   
    class Autentificadora{
        private static $secret_key = 'ClaveSuperSecreta';
        private static $encrypt = ['HS256'];
        private static $aud = NULL;
    
        public static function CrearJWT($data, $exp = (60*5)) : string
        {
            $time = time();
            self::$aud = self::Aud();

            $token = array(
                'iat'=>$time,
                'exp' => $time + $exp,
                'aud' => self::$aud,
                'data' => $data,
                'app'=> "API REST 2021"
            );

            return JWT::encode($token, self::$secret_key);
        }
        public static function Aud() : string
        {
            $aud = new stdClass();
            $aud->ip_visitante = "";

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $aud->ip_visitante = $_SERVER['HTTP_CLIENT_IP'];
            } 
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $aud->ip_visitante = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $aud->ip_visitante = $_SERVER['REMOTE_ADDR'];//La dirección IP desde la cual está viendo la página actual el usuario.
            }
            
            $aud->user_agent = @$_SERVER['HTTP_USER_AGENT'];
            $aud->host_name = gethostname();
            
            return json_encode($aud);//sha1($aud);
        }

        public static function ObtenerPayLoad($token) : object
        {   
            $datos = new stdClass();
            $datos->exito = FALSE;
            $datos->payload = NULL;
            $datos->mensaje = "";

            try {

                $datos->payload = JWT::decode(
                                                $token,
                                                self::$secret_key,
                                                self::$encrypt
                                            );
                $datos->exito = TRUE;

            }catch (Exception $e) { 

                $datos->mensaje = $e->getMessage();
            }

            return $datos;
        }
    }

?>