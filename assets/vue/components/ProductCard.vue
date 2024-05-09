<template>

  <div class="product-card">
    <p> I am a card </p>
<!--
    <p> I am a card {{productInfo.name}}</p>
    <div class="product-card__image-container">
      <img class="product-card__image" src= {{productInfo.mediaurl}}>
    </div>
    <div class="product-card__product-info">
      <p class="product-card__product-name"> {{product.name}} </p>
      <div class="product-card__price-section">
        <p class="product-card__price"> {{product.price}} </p>
        <p class="product-card__offerprice"> {{product.offerprice}} </p>
      </div>
    </div>
-->

  </div>

</template>


<script>

export default {
    name: "ProductCard",
    props: {
      'productInfo': Object
    }
}

</script>



<style scoped>


</style>