
                function openNif() {
                    // Get the checkbox
                    var checkBoxS = document.getElementById("checkS");
                    var checkBoxN = document.getElementById("checkN");
                    // Get the output text
                    var nif = document.getElementById("nif");
    
                    // If the checkbox is checked, display the output text
                    if (checkBoxS.checked == true ){
                        nif.classList.remove("disabled");
                        checkBoxN.checked=false;
    
                    } 
                    
                    } 
    
                    function closeNif() {
                    // Get the checkbox
                    var checkBoxS = document.getElementById("checkS");
                    var checkBoxN = document.getElementById("checkN");
                    // Get the output text
                    var nif = document.getElementById("nif");
    
                    // If the checkbox is checked, display the output text
                    if(checkBoxN.checked == true) {
                        
                        checkBoxS.checked=false;
                        $("#nif").addClass("disabled");
                    }
                   
                    
                    } 