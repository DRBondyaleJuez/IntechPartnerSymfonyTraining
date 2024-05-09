<template>
    <div>
        <header>
            <h1 class="header-title"> PRODUCT CATALOG </h1>
        </header>
        <FilterMenu></FilterMenu>
        <ProductCatalog></ProductCatalog>
    </div>

</template>

<script>

import FilterMenu from '../vue/components/FilterMenu.vue'
import ProductCatalog from '../vue/components/ProductCatalog.vue'

export default {
    name: "App",
    components:{
        FilterMenu,
        ProductCatalog
    }
}

</script>

<style scoped>
header {
    background-color: blue;
}

FilterMenu {
background-color: orange;
}
</style>


<!--


<script setup>
import FilterMenu from './components/FilterMenu.vue'
import ProductCatalog from './components/ProductCatalog.vue'
</script>

<template>
    <div>
    <header>
        <h1 class="header-title"> PRODUCT CATALOG <h1>
    </header>

    <main>
        <FilterMenu />
        <ProductCatalog />
    </main>
    </div>
</template>

<style scoped>
header {
    background-color: blue;
}

main {
background-color: orange;
}
</style>






-->