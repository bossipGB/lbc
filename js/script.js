function openModal() {
    document.getElementById('addProductModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('addProductModal').style.display = 'none';
}


function nextStep(step) {
    document.getElementById('step' + (step - 1)).style.display = 'none';
    document.getElementById('step' + step).style.display = 'block';
}

function prevStep(step) {
    document.getElementById('step' + (step + 1)).style.display = 'none';
    document.getElementById('step' + step).style.display = 'block';
}
