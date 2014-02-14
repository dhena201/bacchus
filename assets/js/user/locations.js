/**
 * @author Lou
 */
$(document).ready(function() {

		$(function() {
			$("#select_all").click(function() {
				if(this.checked) {
            		$(':checkbox').each(function() {
                		this.checked = true;                        
            		});
        		}
        		
        		if(!this.checked) {
           			$(':checkbox').each(function() {
                		this.checked = false;                        
            		});
        		}
			});
		});
		
		$(function() {
			var checkBox;

			/*Deleting an location*/
			$(".delete_button").click(function(){
				checkBox = $(this).parentsUntil("tr").parent().find("td.select > div.checkbox > label > input:checkbox");
			});
			
			$('#deleteLocation').on('show.bs.modal', function () {
				checkBox.attr("checked", true);
				
				var currentAction = $(this).parent().attr("action");
				var newAction = currentAction;
				$('div.checkbox label input:checkbox').each(function() {
                	if(this.checked){
                		newAction += "/" + $(this).val();
                	}                        
            	});
				$(this).parent().attr("action", newAction);
			})
			
			$('#deleteLocation').on('hidden.bs.modal', function () {
				checkBox.attr("checked", false);
			    /* delete everything after delete/... */
			    var currentAction = $(this).parent().attr("action");
				var newAction = currentAction;
				var startIndex = currentAction.lastIndexOf("delete") + 6;
				$(this).parent().attr("action", newAction.substr(0, startIndex));
			})
			
			$(".edit_button").click(function(){
				var href = currentId = $(this).parent().attr("href");
				var currentId = href.substring(href.lastIndexOf("/")+1, href.length);
				var currentHref = $(this).parent().attr("href");
				var newHref = currentHref;
				$('div.checkbox label input:checkbox').each(function() {
                	if(this.checked){
                		var thisHref = $(this).parentsUntil("tr").parent().find("td.edit > a").attr("href");
                		var thisId = thisHref.substring(thisHref.lastIndexOf("/")+1, thisHref.length);
                		if(currentId !== thisId){
                			newHref += "/" + $(this).val();
                		}
                	}                        
            	});
				$(this).parent().attr("href", newHref);
			});
		});
	});