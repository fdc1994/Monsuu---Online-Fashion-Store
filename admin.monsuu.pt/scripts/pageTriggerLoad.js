function loaderTrigger() {
    window.addEventListener('beforeunload', function(event) {
        var loader = document.getElementById("loader");
        loader.classList.remove("disabled");
        loader.classList.add("sk-chase");
      });
   
  }

loaderTrigger();