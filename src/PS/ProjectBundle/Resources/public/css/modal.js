		//model
var modal = document.querySelectorAll(".modal-active");
for (var i = 0; i < modal.length; i++) {
   modal[i].addEventListener('click', 		
     function ConfirmForm() {
       document.getElementById("text-instruction").textContent = this.dataset.text;
       document.getElementById("BlockUIConfirm").style.display = "block";

     }, 
  false);
}

document.getElementById('modal-hide').addEventListener('click', 		
    function(){
        document.getElementById("BlockUIConfirm").style.display = "none";
    }, 
false);

    