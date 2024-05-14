
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
    let quantityToDisplay = (productPrice*numberOfItems/100).toFixed(2);
    shoppingPriceDisplay.innerHTML = quantityToDisplay + " €";
}

//Image Zoom
let zoomableImageSection = document.querySelector('.zoomable-image-section');
let zoomableImage = document.querySelector('.zoomable-image');
let zoomableImageUrl = zoomableImage.getAttribute("src");
zoomableImageSection.style.backgroundImage = 'none';
zoomableImageSection.addEventListener("mousemove",zoomImageAction);

function zoomImageAction(e){
    console.log("mouse hovering over zoomable image");
    zoomableImageSection.style.backgroundImage = 'url(' + zoomableImageUrl +')';

    var zoomer = e.currentTarget;
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX;
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX;
    let x = offsetX/zoomer.offsetWidth*100;
    let y = offsetY/zoomer.offsetHeight*100;
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}

zoomableImageSection.addEventListener("mouseout",()=> {
    zoomableImageSection.style.backgroundImage = 'none';
});
