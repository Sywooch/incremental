<?php
//Includes the scripts required to work our counter.
//Pass In:
//  displayClass - The class name of our display container.
//      EG: <div class='display'></div> => displayClass == 'display'
//  currentCount - Where to start our counter.
//  currentCountIncrement - How much to increment our counter by.
//  secondsBetweenUpdate - How long to wait before updating.
use yii\web\View;
?>

<?php $this->registerJsFile("//code.jquery.com/jquery-2.2.1.min.js", ['position' => View::POS_HEAD]); ?>
<?php $this->registerJsFile("js/incremental-counter.js", ['position' => View::POS_END]); ?>
<div class='counter'></div>
<script>
    (function($) {
        $(document).ready(function () {
            //Initialize Count
            $('.counter').incrementalcounter();          
            var incrementalcounter = $('.counter').data('incrementalcounter');
            //Set Properties
            incrementalcounter.setCount(<?=$currentCount?>);
            incrementalcounter.setIncrement(<?=$currentCountIncrement?>);
            incrementalcounter.setSecondsBetweenUpdate(<?=$secondsBetweenUpdate?>);
            incrementalcounter.setClassOfCountDisplay('<?=$displayClass?>');
        });
    })(jQuery);
</script>

