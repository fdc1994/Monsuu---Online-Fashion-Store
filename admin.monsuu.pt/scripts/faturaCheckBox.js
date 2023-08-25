
                function openClothes() {
                    // Get the checkbox
                    var checkBoxRoupa = document.getElementById("checkRoupa");
                    var checkBoxCalcado = document.getElementById("checkCalcado");
                    // Get the output text
                    var divRoupa = document.getElementById("roupa");
    
                    // If the checkbox is checked, display the output text
                    if (checkBoxRoupa.checked == true ){
                        divRoupa.classList.remove("disabled");
                        checkBoxCalcado.checked=false;
                        $("#calcado").addClass("disabled");
                    } 
                    
                    } 
    
                    function openShoes() {
                    // Get the checkbox
                    var checkBoxRoupa = document.getElementById("checkRoupa");
                    var checkBoxCalcado = document.getElementById("checkCalcado");
                    // Get the output text
                    var divCalcado = document.getElementById("calcado");
    
                    // If the checkbox is checked, display the output text
                    if(checkBoxCalcado.checked == true) {
                        
                        divCalcado.classList.remove("disabled");
                        checkBoxRoupa.checked=false;
                        $("#roupa").addClass("disabled");
                    }
                   
                    
                    } 