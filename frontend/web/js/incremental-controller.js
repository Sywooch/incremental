/*
 * incremental-controller - Bryant Jackson
 * Allows manipulating of game data without reloading the page. This creates a
 * nicer user experience.
 * 
 * EG: The end-user can purchase multiple upgrades without the page reloading.
 * 
 * Use the following class names for any information we want updated. 
 *  NOTE: In all cases, '#' represents the given incrementable's ID number.
 *  
 *  level-# : Level of given incrementable #.
 *  cost-# : Level of given incrementable #.
 *  production-# : Level of given incrementable #.
 */
(function ( $ ) {
    $.updateIncrementableDisplay = function(id, level, cost, production) {
        $(".level-"+id).text(level);
        $(".cost-"+id).text(cost);
        $(".production-"+id).text(production);
    };
 
    $.purchaseIncrementable = function(incrementableId, gameId, baseurl) {
        $.ajax({
            type: "POST",
            url: baseurl + "/game/purchase-incrementable",
            data: {incrementable:incrementableId, game:gameId},
            dataType: "json", // Set the data type so jQuery can parse it for you
            success: function (data) {
                //message: 'success', 'failure', 'null'
                var message = data[0];
                if(message == 'success')
                {
                    //Update display info.
                    var newLevel = data[1];
                    var newCost = data[2];
                    var newProduction = data[3];
                    $.updateIncrementableDisplay(incrementableId, newLevel, newCost, newProduction);
                    //Update counter info.
                    var newPointLevel = data[4];
                    var newProductionLevel = data[5];
                }
            },
            error: function (data) {
                alert("Purchase attempt met server-side issues. If this error occurs, something is very wrong. Please notify administration.");
            }
        });
    };
 
}( jQuery ));