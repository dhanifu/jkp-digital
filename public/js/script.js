$(document).ready(function(){
    // $('#profile_ripple').ripples({
    //     resolution:152,
    //     dropRadius:10
    // });

    const bars = document.querySelectorAll('.progress-bar');
    bars.forEach(function(bar){
        let percentage = bar.dataset.percent;
        let tooltip = bar.children[0];
        tooltip.innerText = percentage + '%';
        bar.style.width = percentage -1 + '%';

        console.log(percentage);
    });


    
});