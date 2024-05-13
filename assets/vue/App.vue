<template>
    <div>
        <header>
            <h1 class="header-title"> PRODUCT CATALOG </h1>
        </header>
        <FilterMenu @apply-sort-criteria = "applySortCriteria" @apply-filter-criteria = "applyFilterCriteria"></FilterMenu>
        <ProductCatalog
            :sortCriteria = "currentSortCriteria"
            :filterCriteria = "currentFilterCriteria"
        ></ProductCatalog>
    </div>
</template>

<script>

import FilterMenu from '../vue/components/FilterMenu.vue'
import ProductCatalog from '../vue/components/ProductCatalog.vue'

export default {
    name: "App",
    data(){
        return{
           currentSortCriteria: 'id',
           currentFilterCriteria: '',
        };
    },
    components:{
        FilterMenu,
        ProductCatalog
    },
    methods: {
        applySortCriteria(appliedSortCriteria){
            console.log('CATALOG PARENT - Apply Sort by: ' + appliedSortCriteria);
            this.currentSortCriteria = appliedSortCriteria;
            console.log('current sort criteria = ' + this.currentSortCriteria);
        },
        applyFilterCriteria(appliedFilterCriteria){
            console.log('CATALOG PARENT - Apply Sort by: ' + appliedFilterCriteria);
            this.currentFilterCriteria = appliedFilterCriteria;
            console.log('current sort criteria = ' + this.currentFilterCriteria);
        }
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