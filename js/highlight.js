$(document).ready(function(){   
  var highlighted = 0;
  document.getElementById("highlighted").innerHTML = highlighted;

  
$(".highlight").click(function(){
	
	
   $(".questions, .answers").hover(function(){
       $(this).toggleClass("black");
         
   });
  
   $(".questions, .answers").click(function(){
        $(this).toggleClass("blacker");
		
		if($(this).hasClass("blacker")){
          highlighted += 1;
          document.getElementById("highlighted").innerHTML = highlighted;
        }
     else{
          highlighted -= 1;
       document.getElementById("highlighted").innerHTML = highlighted;
     }
    });
	
	
       $(this).toggleClass("highlighter");

  });
  


    

  
});