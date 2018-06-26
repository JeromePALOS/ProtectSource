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


	var modal = document.querySelectorAll(".modal-a");
	for (var i = 0; i < modal.length; i++) {
	   modal[i].addEventListener('click', 		
		 function ConfirmForm() {
		   document.getElementById("modal-text").textContent = this.dataset.text;
		   document.getElementById("modal-title").textContent = this.dataset.title;
		   document.getElementById("modal-input").setAttribute('href', this.dataset.input);
		   document.getElementById("BlockUIConfirm").style.display = "block";

		 }, 
	  false);
	}

	document.getElementById('modal-hide').addEventListener('click', 		
		function(){
			document.getElementById("BlockUIConfirm").style.display = "none";
		}, 
	false);
