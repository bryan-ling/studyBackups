$(document).ready(function(){

	/* add  */
	$ (".add").click (function () {
		
		$('<div class="enter">\
		<input type="button" value="^" class="moveUp tableData">\
		<input type="button" value="v" class="moveDown tableData">\
		<textarea class="headBorder2 colorBorderTwo" name="content[]" rows="5" cols="45"></textarea>\
		<textarea class="headBorder2 colorBorderTwo" name="content[]" rows="5" cols="45"></textarea>\
		<button class="less tableData">X</button><br></div>').appendTo("#form");
		window.scrollTo(0,document.body.scrollHeight);
		
		
	});

	
	$ (".addHead").click (function () {
		
		$('<div class="enter">\
		<input type="button" value="^"  class="moveUp tableHead">\
		<input type="button" value="v" class="moveDown tableHead">\
		<input style="display: none;" name="content[]" type="text" value="!@#head!@#">\
		<textarea class="headBorder colorBorder" name="content[]" rows="1" cols="95"></textarea>\
		<button class="less tableHead">X</button><br></div>').appendTo("#form");
		window.scrollTo(0,document.body.scrollHeight);
		
		
	});
	
	
	$ (".addTitle").click (function () {
		
		$('<div class="enter titleMargin">\
		<input type="button" value="^" class="moveUp tableTitle">\
		<input type="button" value="v" class="moveDown tableTitle">\
		<input style="display: none;" name="content[]" type="text" value="!@#title!@#">\
		<textarea class="headBorder colorBorder"name="content[]" rows="2" cols="95"></textarea>\
		<button class="less tableTitle">X</button><br></div>').appendTo("#form");
		window.scrollTo(0,document.body.scrollHeight);
	});
	
	
	
	/*delete*/
	
	$('#form').on('click', '.less',function () {
	
	$(this).parents('.enter').remove();

	});
	
	
	/*move up and down */
	
	$('#form').on('click', '.moveUp',function () {
		var $parent = $(this).parents('.enter').closest('.enter');
		$parent.insertBefore($parent.prev());           
	
	});


	$('#form').on('click', '.moveDown',function () {
		var $parent = $(this).parents('.enter').closest('.enter');
		$parent.insertAfter($parent.next());   
		
	});
	
	/*Settings Panel*/
	$("#closeColors").click (function () {
		$("#closeColors").fadeOut(200);
		$(".editColors").fadeOut(200);
		x = 0;
	});
	var x = 0;
	$(".openColors").click (function () {
		if (x===0){
			$("#closeColors").fadeIn(200);
			$(".editColors").fadeIn(200);
			x = 1;
		}
		else{
			$("#closeColors").fadeOut(200);
			$(".editColors").fadeOut(200);
			x = 0;
		}
		
		
	});
	
	
});