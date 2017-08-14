$(document).ready(function(){
    $(".ShowAnswersButton").click(function(){
        $(".answers").toggleClass("answersall");
		$(".ShowAnswersButton").toggleClass("colorTwo");
    });
	$(".ShowQuestionsButton").click(function(){
        $(".questions").toggleClass("questionsall");
		$(".ShowQuestionsButton").toggleClass("ShowAllQuestionsButtonClick");
    });
	
	
	
	$(".UnitSelect").click(function(){

		$(this).toggleClass("UnitOneUnselect");
    });
	
	
	

	$(".bigTitle").each(function(index){
		index = index + 1;
		$("#unit" +index ).click(function(){

			$(".unit" +index ).toggleClass("HideUnit");
			
		});

		
	
    });
	
    $(".editButton").click(function() {
        var $this = $(this);

        $this.toggleClass("expanded");

        if ($this.hasClass("expanded")) {
            $this.html("Back");
        } else {
            $this.html("Edit Info");
        }
		
		$(".doneEditing").toggle();
		$(".editing").toggleClass("shower");
    });

	

		
	
});
