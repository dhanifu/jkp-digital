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

    // function a(){
        // con
        // const dropDown = document.getElementById('dropDown');
        // dropDown.classList.add('active');
        // alert('masuk');
    // }
    
        


    
});
const dropDown = document.getElementById('dropDown');
const tombolDropDown = document.querySelectorAll('.right-info .icon-nav');
const tombolCard = document.querySelectorAll('.content-table .header-content-table .tombol-card');

const clickButton = document.querySelectorAll('.click');
const contentTable = document.querySelector('.content-table');
const tinggiContentTable = document.querySelector('.content-table').clientHeight;
const tinggi = document.querySelector('.content-table');
tinggi.style.height = '40px';

clickButton[1].onclick = function(){
    tombolDropDown[0].style.display = 'block';
    tombolDropDown[1].style.display = 'none';
    dropDown.style.display = 'inline-block';
    dropDown.style.opacity = '1';
    dropDown.style.transition = 'opacity 5s ease 2s';
}

clickButton[0].onclick = function(){
    tombolDropDown[0].style.display = 'none';
    tombolDropDown[1].style.display = 'block';
    dropDown.style.display = 'none';
    dropDown.style.opacity = '0';
    dropDown.style.transition = 'opacity 0.5s ease 2s';
}

clickButton[2].onclick = function(){
    tombolCard[0].style.display = 'none';
    tombolCard[1].style.display = 'block';
    // dropDown.style.opacity = '0';
    contentTable.style.height = tinggiContentTable - 40 + 'px';
    contentTable.style.overflow = 'hidden';
    contentTable.style.transition = 'height 0.5s';
}
clickButton[3].onclick = function(){
    tombolCard[0].style.display = 'block';
    tombolCard[1].style.display = 'none';
    // dropDown.style.opacity = '0';
    contentTable.style.height = '40px';
    contentTable.style.transition = 'all 0.5s';
}
