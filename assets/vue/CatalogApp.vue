<template>
    <div>
        <header>
            <h1 class="header-title"> PRODUCT CATALOG </h1>
            <div class="shopping-cart-pluggin">
                <div class="shopping-cart-pluggin__icon">
                    <img class="icon-image" src="https://cdn-icons-png.freepik.com/128/2838/2838838.png">
                </div>
                <p class="shopping-cart-pluggin__price-display"> {{ moneyParser(getTotalCost) }} </p>
            </div>
         </header>

         <FilterMenu @apply-sort-criteria = "applySortCriteria" @apply-filter-criteria = "applyFilterCriteria"></FilterMenu>

        <CardDisplay
            :sortCriteria = "currentSortCriteria"
            :filterCriteria = "currentFilterCriteria"
        ></CardDisplay>
    </div>
</template>

<script>

import FilterMenu from './components/FilterMenu.vue'
import CardDisplay from './components/CardDisplay.vue'
import { useShoppingCartStore } from '../stores/shoppingCartStore.js'
import { mapState } from 'pinia'

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
        CardDisplay
    },
    computed:{
        ...mapState(useShoppingCartStore,['getTotalCost'])
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
        },
        moneyParser(intValue){
            return (intValue/100).toFixed(2) + " €";
        }
    },
}

</script>

<style scoped>

</style>


