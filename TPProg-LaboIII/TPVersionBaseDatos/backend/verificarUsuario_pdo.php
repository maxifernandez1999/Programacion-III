<?php
    session_start();
    include("Fabrica.php");
    if (isset($_POST['txtDni']) && isset($_POST['txtApellido'])){
        $dni = $_POST['txtDni'];
        $apellido = $_POST['txtApellido'];
        $objFabrica = new Fabrica("xd");
        $consulta = $objFabrica->SelectEmpleados();
        $resultado = $consulta->fetchAll();
        foreach ($resultado as $value) {
            if($value["dni"] == $dni && $value["apellido"] == $apellido){
                $_SESSION['DNIEmpleado'] = $dni;
                $retorno = true;
                header("Location: ./principal_pdo.php");         
                break;
            }else{
                $retorno= false;
            }
        }
        if ($retorno == false) {
            ?>
            <style>
                div{
                    text-align: center;
                }
                h1{
                    font-size: 40px;
                    color: black;
                    text-align: center;
                }
                a{
                    font-size: large;
                    color: black;
                    font-size: 30px;
                    text-decoration: none;
                    text-align: center;
                    padding: .5%;
                    border-radius: 20px;
                }
                a:hover{
                    color: white;
                    background-color: black;
                    transition: 0.3s;
                }
            </style>
            <div>
                <h1>Error, dni o apellido incorrectos</h1><hr>
                <a href="../index.php">Volver a LOGIN</a>
            </div>
            <?php
        }




    }
?>