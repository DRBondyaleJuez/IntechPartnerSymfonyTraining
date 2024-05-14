<template>
    <div>
        <header>
            <h1 class="header-title"> PRODUCT CATALOG </h1>
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

</style>


