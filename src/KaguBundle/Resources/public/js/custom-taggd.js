var image = document.getElementById('ambiance');
var options = {};
var data = [];
var i = 0;
			
var taggd = new Taggd(image, options, data);

$(document).ready(function(){
	    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#ambiance').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
        var image = document.getElementById('ambiance');
    });

    $('#ambiance').click(function(event){
    	var x = event.offsetX;
    	var y = event.offsetY;
    	x = x * 100 / $(this).width();
    	y = y * 100 / $(this).height();
    	
    	var tag = taggd.addTag(
    		Taggd.Tag.createFromObject({
	    		position: { x: x / 100,  y: y / 100  },
	    		text: '<span class="delete" data-index="' + i + '" >X</span><input type="text" placeholder="Titre" id="titre"><input placeholder="description" type="text" id="description"/><input type="text" id="prix" placeholder="prix"/>',
	  		}).setButtonAttributes({
	  			id : i,
  				class : 'button'
	  		}).setPopupAttributes({
	  			class : 'popup'
	  		})
  		);
  		$('.delete').click(function(){
    	var index = $(this).attr('data-index');    	
    	var tags = taggd.getTags();
    	for (var tag in tags){
    		if(taggd.getTag(parseInt(tag)).buttonElement.id == index){
    			taggd.deleteTag(parseInt(tag));
    			}
    		}
		});
  		i++;
	});

	$('#submit').click(function(){
		var title = $('')
	})
  		
});

