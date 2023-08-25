<?php 

   
include("encontraprodutoscarrinho.php");
        

if ($totalprodutos>0) {
                        $precototal =0;
                        for ($i = 0; $i < count($idsEncontrados); $i++) {
                            
                            $sql = "SELECT * FROM produtos WHERE id =".$idsEncontrados[$i]." LIMIT 1";
                      
                            $resultado_final = mysqli_query($ligacao, $sql);
                            $count=0;
                            $row = $resultado_final->fetch_assoc();
                            
                            include("admin/encontradesconto.php");
                           
                            $precototal+= $precofinal * $quantidadeID[$i];
                        }
                    }

                        echo number_format($precototal,2);
                            ?>
                        