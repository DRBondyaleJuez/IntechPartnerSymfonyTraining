<template>

  <div class="product-card">
    <div class="product-card__image-container">
      <img class="product-card__image" :src="productInfo.mediaurl" v-on:click="goToProductPage()">
      <button class="product-card__add-to-cart-button dark-button">Add product</button>
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
    }
  },
}

</script>



<style scoped>


</style>