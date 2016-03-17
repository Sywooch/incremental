/*
 * incremental-counter - Bryant Jackson
 * Controls client-side display of the counter for an incremental game.
 * 
 * TO USE-----------------------------------------------------------------------
    <div class='display'></div>
    <div class='counter'></div>
    <script>
        //Initialize Count
        $('.counter').incrementalcounter();          
        var incrementalcounter = $('.counter').data('incrementalcounter');
        //Set Properties
        incrementalcounter.setCount(1000);
        incrementalcounter.setIncrement(1);
        incrementalcounter.setSecondsBetweenUpdate(1);
        //Set Controls
        incrementalcounter.setClassOfCountDisplay('display');
    </script>
 * -----------------------------------------------------------------------------
 */

(function($) {
    var IncrementalCounter = function(element)
    {
        var elem = $(element);
        var obj = this;
        //Properties
        var count = 0;
        var increment = 0;
        var secondsBetweenUpdate = 1;
        var incrementPerClick = 0;
        //Control Class Names
        var countDisplay = "";
        //Methods.
        this.setCount = function(value) {
            count = value;
        };
        this.setIncrement = function(value) {
            increment = value;
        };
        this.setSecondsBetweenUpdate = function(value) {
            secondsBetweenUpdate = value;
        };
        this.setClassOfCountDisplay = function(value) {
            countDisplay = value;
        };
        this.setIncrementPerClick = function(value) {
            incrementPerClick = value;
        };
        this.updateCountDisplay = function() {
            if(countDisplay != "")
                $("." + countDisplay).text(count);
        };
        this.incrementCount = function() {
            count += increment;
        };
        this.incrementClick = function() {
            count += incrementPerClick;
        };
        this.addToCount = function(value) {
            count += value;
        };
        window.setInterval(this.incrementCount, secondsBetweenUpdate * 1000); //Convert secondsBetweenUpdate to milliseconds.
        window.setInterval(this.updateCountDisplay, secondsBetweenUpdate * 1000); //Convert secondsBetweenUpdate to milliseconds.
    };
    //Constructor.
    $.fn.incrementalcounter = function()
    {
        return this.each(function() {
            var element = $(this);
            //Check if we already have an instance of this plugin.
            if(element.data('incrementalcounter'))
                return;
            var incrementalcounter = new IncrementalCounter(this);
            //Store object on this element.
            element.data('incrementalcounter', incrementalcounter);
        });
    };   
}(jQuery));

