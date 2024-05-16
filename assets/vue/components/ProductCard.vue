<template>

  <div class="product-card">
    <div class="product-card__image-container">
      <img class="product-card__image" :src="productInfo.mediaurl" v-on:click="goToProductPage()">
      <button class="product-card__add-to-cart-button dark-button" v-on:click="addProductClicked()">Add product</button>
    </div>
    <div class="product-card__product-info">
      <p class="product-card__product-name"> {{productInfo.name.toLowerCase()}} </p>
      <div class="product-card__price-section">
        <p class="product-card__price"> {{moneyParser(productInfo.price)}} </p>
        <p class="product-card__offerprice"> {{moneyParser(productInfo.offerprice)}} </p>
      </div>
    </div>
  </div>

</template>


<script>

//Store related imports
import { useShoppingCartStore } from '../../stores/shoppingCartStore.js'
import { mapActions } from 'pinia'

export default {
  name: "ProductCard",
  props: {
    'productInfo': Object
  },
  methods: {
    goToProductPage(){
      location.href = "../product/" + this.productInfo.productid;
    },
    moneyParser(intValue){
      return (intValue/100).toFixed(2) + " €";
    },
    addProductClicked(){
      let addedProduct = {
        productid: this.productInfo.productid,
        amount: 1,
        price: this.productInfo.offerprice
      };
      this.addProductToShoppingCart(addedProduct);
    },
    ...mapActions(useShoppingCartStore,['addProductToShoppingCart'])
  }
}

</script>



<style scoped>


</style>