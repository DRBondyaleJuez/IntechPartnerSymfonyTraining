<template>
  <div class="card-display-section">
    <div class="product-card-section">
      <ProductCard v-for="currentProductInfo in productInfoList"
      v-bind:productInfo="currentProductInfo" v-bind:key="currentProductInfo.productid">
    </ProductCard>
    </div>
  </div>
</template>

<script>
import ProductCard from "./ProductCard.vue";

export default {
  name: "ProductCatalog",
  components: {
    ProductCard
  },
  props: {
    sortCriteria: String,
    filterCriteria: String,
  },
  data() {
    return {
      productInfoList: []
    };
  },
  created() {
    this.buildProductCardSection();
  },
  watch:{
    sortCriteria() {
        this.buildProductCardSection();
    },
    filterCriteria() {
        this.buildProductCardSection();
    }
  },
  methods: {
    async buildProductCardSection() {
      try {
        this.productInfoList =  await this.requestProductInfo();
      } catch (error) {
        console.error(`Unable to build product card section: ${error}`);
      }
    },

    async requestProductInfo() {
      try {
        let request = "../catalogAPI?sortBy=" + this.sortCriteria + "&filterBy=" + this.filterCriteria;
        let productInfoListResponse = await fetch(request, {
          method: "GET",
        });

        return productInfoListResponse.json();
      } catch (error) {
        console.error(`Could not get products: ${error}`);
      }
    },
  },
};
</script>

<style scoped>
</style>