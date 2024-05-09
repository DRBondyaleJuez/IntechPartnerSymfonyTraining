
// Description Interaction
let productDescriptionTitleSection = document.querySelector('.product-description-section__title-section');

productDescriptionTitleSection.addEventListener("click", hideDescriptionDropdown);

function hideDescriptionDropdown(){
    let productDescriptionDropdownContent = document.querySelector('.product-description-section__dropdown-content');
    if(productDescriptionDropdownContent.style.display =='none'){
        productDescriptionDropdownContent.style.display ='block';
    } else {
        productDescriptionDropdownContent.style.display ='none';
    }
}

// Spinner Interaction
let quantityInput = document.querySelector('.quantity-input');
quantityInput.value = 1;
let spinnerUpButton = document.querySelector('.spinner-arrows__up');
let spinnerDownButton = document.querySelector('.spinner-arrows__down');

spinnerUpButton.addEventListener("click", increaseQuantityInput);
spinnerDownButton.addEventListener("click", decreaseQuantityInput);

function increaseQuantityInput(){
    quantityInput.value++;
}

function decreaseQuantityInput(){
    if(quantityInput.value>1){
        quantityInput.value--;
    }
}

// Add to cart Interaction
let addToCartButton = document.querySelector('.add-to-cart-button');
let productPrice = document.querySelector('.product-offerprice').dataset.price;
let shoppingPriceDisplay = document.querySelector('.shopping-cart-pluggin__price-display');

addToCartButton.addEventListener("click", addQuantityToShoppingCart);
function addQuantityToShoppingCart() {
    console.log("Add to cart clicked");
    let numberOfItems = quantityInput.value;
    let productPrice100 = parseFloat(productPrice)*100;
    let quantityToDisplay = (productPrice100*numberOfItems/100).toFixed(2);
    shoppingPriceDisplay.innerHTML = quantityToDisplay + " €";
}
