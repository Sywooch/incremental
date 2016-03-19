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
    $.updateIncrementableDisplay = function(id, level, cost, production, name, urlBio) {
        $(".level-"+id).text(level);
        $(".cost-"+id).text(cost);
        $(".production-"+id).text(production);
        $(".name-"+id).text(name);
        $(".image-bio-"+id).attr("src", urlBio);
    };
    
    $.updateClickDisplay = function(cost, production) {
        $(".clicker-cost").text(cost);
        $(".clicker-production").text(production);
    };
    
    $.updateCounterDisplay = function(incrementalcounter, points, production) {
        incrementalcounter.setCount(points);
        incrementalcounter.updateCountDisplay();
        incrementalcounter.setIncrement(production);
        $(".counter-increment").text(production);
    }
 
    $.purchaseIncrementable = function(incrementableId, gameId, baseurl, incrementalcounter) {
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
                    var newName = data[6];
                    var newBioImage = data[7];
                    $.updateIncrementableDisplay(incrementableId, newLevel, newCost, newProduction, newName, newBioImage);
                    //Update counter info.
                    var newPointLevel = data[4];
                    var newProductionLevel = data[5];
                    var newPremium = data[8];
                    $.updateCounterDisplay(incrementalcounter, newPointLevel, newProductionLevel);
                    $('.premium').text(newPremium);
                }
                else if(message == 'prompt-premium')
                {
                    //Display premium prompt.
                    $('#packages-popup').bPopup({position: [0,0]});
                }
            },
            error: function (data) {
                alert("Purchase attempt met server-side issues. If this error occurs, something is very wrong. Please notify administration.");
            }
        });
    };
    
    $.purchaseTapUpgrade = function(gameId, baseurl, incrementalcounter) {
        $.ajax({
           type: "POST",
            url: baseurl + "/game/purchase-tap-upgrade",
            data: {game:gameId},
            dataType: "json", // Set the data type so jQuery can parse it for you
            success: function (data) {
                //message: 'success', 'failure', 'null'
                var message = data[0];
                if(message == 'success')
                {
                    var tapCost = data[1];
                    var tapProduction = data[2];
                    var newPoints = data[3];
                    //Update counter info.
                    incrementalcounter.setIncrementPerClick(tapProduction);
                    $.updateClickDisplay(tapCost, tapProduction);
                    incrementalcounter.setCount(newPoints);
                    incrementalcounter.updateCountDisplay();
                }
            },
            error: function (data) {
                alert("Purchase attempt met server-side issues. If this error occurs, something is very wrong. Please notify administration.");
            }
        });
    };
    
    $.performTap = function(gameId, baseurl, incrementalcounter) {
        $.ajax({
           type: "POST",
            url: baseurl + "/game/perform-tap",
            data: {game:gameId},
            dataType: "json", // Set the data type so jQuery can parse it for you
            success: function (data) {
                var tapValue = data[0];
                incrementalcounter.addToCount(tapValue);
                incrementalcounter.updateCountDisplay();
            },
            error: function (data) {
                alert("Purchase attempt met server-side issues. If this error occurs, something is very wrong. Please notify administration.");
            }
        });
    };
 
}( jQuery ));