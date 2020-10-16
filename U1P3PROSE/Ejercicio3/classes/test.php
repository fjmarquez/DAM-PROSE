
<?php 

    class test{
        private $q1;
        private $q2;
        private $q3;
        private $sol = [2, 3, 2];
        private $cont = 0;

        function corregirTest($q1, $q2, $q3){
            if ($q1 == $this -> sol[0]){
                $this ->cont = $this ->cont + 1;
                }
            if ($q2 == $this -> sol[1]){
                $this ->cont = $this ->cont + 1;
                }
            if ($q3 == $this -> sol[2]){
                $this ->cont = $this ->cont + 1;
                }

            echo "Has acertado " . $this -> cont . " preguntas. <br><br>";
            
        }

        function mostrarImg(){
            if ($this-> cont == 0){
                echo "<img height='150' width='150' src='https://lh3.googleusercontent.com/proxy/hXX3iYZNnvxJoz5FSRcrCDcHbNpfE8nheGQUP7SY2sp335WscKIXXYV6FSqmfMGJ_zmpUhLd-17KHPa4oGiIyUmMqm-y9gj7mvt_QdPM13J3TDrwsaNNsj-xXTXqnP3JKbfPWYJMVT9a0TSioiQZ4ptlP08paMFEEuoIITc'/>";
            }
            if ($this-> cont == 1){
                echo "<img height='150' width='150' src='https://cdn.shopify.com/s/files/1/1061/1924/files/Eye_Roll_Emoji_large.png?v=1541768914'/>";
            }
            if ($this-> cont == 2){
                echo "<img height='150' width='150' src='https://i.pinimg.com/originals/88/c4/09/88c409ecd4f9faf465e5d820fc34048a.png'/>";
            }
            if ($this-> cont == 3){
                echo "<img height='150' width='150' src='https://static.vecteezy.com/system/resources/previews/001/192/834/non_2x/emoji-yellow-face-sun-glasses-png.png'/>";
            }
        }

    }

?>
