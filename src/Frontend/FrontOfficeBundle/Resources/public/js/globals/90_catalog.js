function displayCatalogGameCard(_id, _path)
{
	$.ajax({
        url : _path,
        dataType : 'json', // on spécifie bien que le type de données est en JSON
        data : {
            id : _id
        },
        success : function(data){
            $("#card-loader").hide();
            $("#card-data").show();
            
            var game = data.game[0];
            
            $("#card-name").html(game.username+' vend :');
            
            
            var photos = "";
            if(game.image_1 != null)
            {
                photos += "<div><img class=\"card-img img-responsive img-rounded\" src=\"/rompy/web/pictures/"+game.game_id+"/"+game.image_1+"\" class=\"img-rounded\" /></div>";     
            }
            if(game.image_2 != null)
            {
                photos += "<div><img class=\"card-img img-responsive img-rounded\" src=\"/rompy/web/pictures/"+game.game_id+"/"+game.image_2+"\" class=\"img-rounded\" /></div>";     
            }
            if(game.image_3 != null)
            {
                photos += "<div><img class=\"card-img img-responsive img-rounded\" src=\"/rompy/web/pictures/"+game.game_id+"/"+game.image_3+"\" class=\"img-rounded\" /></div>";     
            }
            $('#card-data-photos').html(photos);
            
            $('#card-data-photos').slick();
            
            $("#card-data-name").text(game.name);
            
            $("#card-data-year").text(game.year);
            
            if(game.alternative_name != null)
                $("#card-data-name-bis").text(game.alternative_name);
            else
                $("#card-data-name-bis").hide();
                
            $("#card-data-plateform").text(game.plateform);
            
            $("#card-data-type").text(game.game_type);
            
            if(game.serie != null)
                $("#card-data-serie").text(game.serie);
            else
            {
                $("#card-data-serie").hide();
                $("#card-data-serie-label").hide();
            }
                
            var edit = "";
            if(game.editor_1 != null)
                edit += "• "+game.editor_1+"<br />";
            if(game.editor_2 != null)
                edit += "• "+game.editor_2+"<br />";
            if(game.editor_3 != null)
                edit += "• "+game.editor_3+"<br />";
            edit += "";
            $("#card-data-editors").html(edit);
            
            $("#card-data-language").text(game.language);
            
            if(game.game_package)
                $("#card-data-package").text("Oui");
            else
                $("#card-data-package").text("Non");
            
            if(game.blister)
                $("#card-data-blister").text("Oui");
            else
                $("#card-data-blister").text("Non");
                
            if(game.notice)
                $("#card-data-notice").text("Oui");
            else
                $("#card-data-notice").text("Non");
            
            $("#card-data-state").text(game.state);
            
            $("#card-data-zone").text(game.zone);
            
            $("#card-data-price").text(game.price+" €");
            
            if(game.comment != null)
                $("#card-data-comment").text(game.comment);
            else
                $("#card-data-comment").hide();
        },
        error : function(jqXHR, textStatus, errorThrown)
        {
            alert("Une erreur est survenue lors de la recherche des jeux, merci de re-essayer.");
        },
        timeout: 120000
    });
}

