$.prototype.carrousel = function(images = []){
    
        var $container = this;
        for(var image of images){ //pour chaque image passé en parametre
            var $div = $("<div></div>"); // on crée une nouvelle div avec jquery
            $div.css({ //On set les styles avec javascript
                "width" : "100%",
                "height" : "100%",
                "background-size" : "cover",
                "background-position" : "center",
                "background-image" : "url(" + image + ")"
    
            });
            $container.append( $div );// on ajoute la div dans le container
        }
    
        var $items = $container.children("div");
        $items.hide();
        var $currentItem = $items.first();
        $currentItem.show();
    
        var mouse_flag = true; // on empeche de cliquer tant que l'animation n'est pas terminée
    
        $container.click(function(){
    
            if(mouse_flag == false){ // si une animation est en cours, on arrete tout
                return;
            }
            mouse_flag = false;// On signale qu'il est possible de cliquer
    
            $currentItem.fadeOut(300, function(){
    
                $currentItem = $currentItem.next();
                if( $currentItem.length == 0){
                    $currentItem = $items.first();
    
                }
                $currentItem.fadeIn(300, function(){
                    mouse_flag = true;// on signale que lon peut cliquer à nouveau
                });
    
            });
        
        })
    
    }