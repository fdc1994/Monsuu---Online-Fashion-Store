<?php
                        $precofinal;
                            $sqldescontos = "SELECT desconto FROM promocoes WHERE id = ".$row['id'];
                            $resultdescontos = mysqli_query($ligacao, $sqldescontos);
                            $rowdescontos = $resultdescontos->fetch_assoc();
                            if(isset($rowdescontos)) {
                                $desconto = $rowdescontos['desconto'];
                                $preco = $row['preco'];
                                $precofinal = $preco - ($preco *("0.".$desconto));
                            }
                            else{
                                $precofinal = $row['preco'];
                            }
                            ?>