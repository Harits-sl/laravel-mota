const radioButton = document.getElementsByName("btnradio");
const idOrder = document.querySelector(".id-order");
const totalOrder = document.querySelector(".total-order");
const change = document.querySelector(".change");
const formPay = document.querySelector(".form-pay");
const formChange = document.querySelector(".form-change");
const buttonSubmit = document.querySelector(".btn-submit");
const imageModal = document.querySelector(".image-modal");
// const form = document.querySelector("form");

//
let totalPrice = 0;
let valuePay = 0;
let _id = "";

// datePicker
$("#datepicker-1").datepicker();
$("#datepicker-2").datepicker();

function addChecked(payInput) {
    payInput.checked = true;
}

function removeChecked(payInput) {
    payInput.checked = false;
}

function removeAllChecked() {
    for (const pay of radioButton) {
        pay.checked = false;
    }
}

function changeReturn() {
    change.textContent = valuePay - totalPrice;
    formChange.value = valuePay - totalPrice;
}

// memasukan data ke modal
// ambil data dari php html
function returnDataToModal(id, total) {
    _id = id;
    idOrder.textContent = id;
    totalOrder.textContent = total;
    totalPrice = total;
    valuePay = radioButton[0].value;
    formPay.value = radioButton[0].value;
    changeReturn();
}

for (const pay of radioButton) {
    pay.addEventListener("click", () => {
        removeAllChecked();
        valuePay = pay.value;
        formPay.value = pay.value;
        addChecked(pay);
        changeReturn();
    });
}

formPay.addEventListener("input", (event) => {
    valuePay = event.target.value;

    for (const pay of radioButton) {
        if (pay.value != valuePay) {
            removeChecked(pay);
        } else {
            addChecked(pay);
        }
    }
    changeReturn();
});

function submitPay(form) {
    form.action = `/admin/transactions/pay/${_id}`;
}

function sendImageToModal(image) {
    console.log("image modal");
    console.log(image);
    console.log(imageModal);
    imageModal.src = image;
}
