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
        console.log(taggd);
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
	  			class : 'popup pop-' + i
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

    $('form#img').on('submit', function(e){
        e.preventDefault();
        var $form = document.getElementById("img");
        console.log($form[0]);
        var data = new FormData($form[0]);
        $.ajax({
            url: Routing.generate('kagu_upload_image'),
            type: 'POST',
            method: 'POST',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            cache:false,
            dataType: 'json', // selon le retour attendu
            data: new FormData($form),
            success: function (response) {
                // La réponse du serveur
                data = {};
                tags = {};
                var width = $('#ambiance').width();
                var height = $('#ambiance').height();
                data['title'] = $('input[name=titre]').val();
                data['description'] = $('textarea[name=description]').val();
                for(var j = 0; j < taggd.tags.length; j++){
                    var tag = {};
                    tag['x'] = ((taggd.tags[j].buttonElement.offsetLeft * 100) / width) /100;
                    tag['y'] = ((taggd.tags[j].buttonElement.offsetTop * 100) / height) /100;
                    tag['titre'] = $('.pop-'+ j +' > input#titre').val();
                    tag['description'] = $('.pop-'+ j +' > input#description').val();
                    tag['prix'] = $('.pop-'+ j +' > input#prix').val();                
                    tags[j] = tag;            
                }
                data['tags'] = tags
                data['img'] = response.filename;
                data['ref'] = ms1.getValue();
                console.log(data);
                data = JSON.stringify(data);                
                $.post(Routing.generate('kagu_add_exe_ambiance', {data : data}), function(result){
                    location.href = Routing.generate('kagu_index_ambiance');
                });  
               
                                      
            }   
        });
    });

	$('#submit').click(function(event){ 
            $('form#img').submit();                 
                     
	});
  		
});

