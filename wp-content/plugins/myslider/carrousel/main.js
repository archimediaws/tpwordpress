// var $h1 = $("h1");
// $h1.click(function(){

//     $(".test").green();

// });



//Je vais rajouter une fonctionnalité a jquey
$.prototype.green = function(){
    this.css("color", "green");
}


$.prototype.clickGreen = function(){

    this.click(function(){
        $(this).green();
    })

}

$(".test").clickGreen();
$("h1").clickGreen();


//Carrousel en procedural
var $carrousel = $("#carrousel");
var $items = $carrousel.children(".item");
$items.hide();
var $currentItem = $items.first();
$currentItem.show();

var mouse_flag = true; // on empeche de cliquer tant que l'animation n'est pas terminée

$carrousel.click(function(){

    if(mouse_flag == false){ // si une animation est en cours, on arrete tout
        return;
    }

    mouse_flag = false; // On signale qu'il est possible de cliquer
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



////Carrousel en objet

var images = [
"images/bg1.jpg",
"images/bg2.jpg",
"images/bg3.jpg",
"images/bg4.jpg",
];
$("#carrousel_2").carrousel(images);
$("#carrousel_3").carrousel(images);
