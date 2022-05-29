let seatsQ = document.getElementById('seatsQ');
let seatCount = 0;
let continueBtn = document.getElementById('continueBtn');

function seatsCounter(elem){
    if(elem.checked){
        if(++seatCount == 1){
            continueBtn.disabled = false;
            seatsQ.innerText = seatCount + " seat selected";
        }
        else seatsQ.innerText = seatCount + " seats selected";
    }
    else{
        if(--seatCount == 0){
            continueBtn.disabled = true;
            seatsQ.innerText = '';
        }
        else if(seatCount == 1) seatsQ.innerText = seatCount + " seat selected";
        else seatsQ.innerText = seatCount + " seats selected";
    }
}