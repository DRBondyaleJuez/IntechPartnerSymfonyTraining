<template>
  <div class="product-catalog-section">
    <p>I AM THE CATALOG</p>
    <div class="product-card-section">
      <p>{{ testMessage }}</p>
      <p>{{ finalMessage }}</p>
      <p>{{ productInfoList.length }}</p>
      <p v-for="currentProductInfo in productInfoList"> {{currentProductInfo.name}}</p>
     <!--

        <ProductCard productInfo={{productInfoExample}}></ProductCard>
      -->
    </div>
  </div>
</template>

<script>
import ProductCard from "./ProductCard.vue";

export default {
  name: "ProductCatalog",
  components: {
    ProductCard,
  },
  data() {
    return {
      testMessage: "Hello World"
    };
  },
  created() {
    this.buildProductCardSection();
  },
  computed:{
    finalMessage(){
      return this.testMessage + testFunction();
    }
  },
  methods: {
    async buildProductCardSection() {
      try {
        let productInfoList = ref( await this.requestProductInfo());
        console.log("Product Info list:");
        console.log(this.productInfoList);

        let productCardSectionHtml = "";
        for (let i = 0; i < this.productInfoList.length; i++) {
          let currentProductInfo = this.productInfoList[i];
          let currentProductCardHtml = `<ProductCard productInfo=${currentProductInfo}></ProductCard> \n`;
          productCardSectionHtml += currentProductCardHtml;
        }

        console.log("Product card section html:");
        console.log(productCardSectionHtml);

        let productCardSection = document.querySelector(
          ".product-card-section"
        );
        //productCardSection.innerHTML = productCardSectionHtml;

        this.testMessage = this.productInfoList[0].name;

      } catch (error) {
        console.error(`Unable to build product card section: ${error}`);
      }
    },

    async requestProductInfo() {
      try {
        let productInfoListResponse = await fetch("../catalogAPI", {
          method: "GET",
        });

        return productInfoListResponse.json();
      } catch (error) {
        console.error(`Could not get products: ${error}`);
      }
    },
  },
};

function testFunction(){
  return '12345';
}

</script>



<style scoped>
</style>