<?php
                        $precofinal;
                            $sqldescontos = "SELECT desconto FROM promocoes WHERE id = ".$row['id'];
                            $resultdescontos = mysqli_query($ligacao, $sqldescontos);
                            $rowdescontos = $resultdescontos->fetch_assoc();
                            if(isset($rowdescontos)) {
                                $desconto= $rowdescontos['desconto'];
                                
                                $preco = $row['preco'];
                                $precofinal = $preco - ($preco *("0.".sprintf("%02d", $desconto)));
                            }
                            else{
                                $desconto = null;
                                $precofinal = $row['preco'];
                            }
                            ?>