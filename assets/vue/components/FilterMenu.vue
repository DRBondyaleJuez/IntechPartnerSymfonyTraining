<template>
  <div class="filter-menu-section">
    <div class="filters-section-wrapper">

      <div class="sort-section">
        <h3> Sort by: </h3>
        <div class="sort-dropdown-section">
          <button class = "sort-input">
            <p class = "sort-input__label"></p>
            <p>▼</p>
          </button>
          <div class = "sort-dropdown">
            <ul class="sort-dropdown__list">
              <li class="sort-dropdown__list-item" v-on:click="sortProductCatalog('Name')">Name</li>
              <li class="sort-dropdown__list-item" v-on:click="sortProductCatalog('Price')">Price</li>
              <li class="sort-dropdown__list-item" v-on:click="sortProductCatalog('ProductID')">ProductID</li>
            </ul>
          </div>
        </div>

      </div>

      <div class="text-filter-section">
        <input class = "text-filter-input" v-on:keyup.enter="applyFilter()" v-on:keyup="applyFilter()">
        <button class = "text-filter-button" v-on:click="applyFilter()"> 🔍 </button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name:"FilterMenu",
    data() {
      return {
        sortDropdownCriteria:['Name', 'Price', 'ProductID'],
        previousFilterParameterLength: 0
      };
    },
    methods: {
      buildSortCriteriaDropdown(){
        for(let i=0; i<this.sortDropdownCriteria.length; i++){
          let currentItemHtml = `<li class="sort-dropdown__list-item" v-on:click="sortProductCatalog('${this.sortDropdownCriteria[i]}')">${this.sortDropdownCriteria[i]}</li>`;
          document.querySelector('.sort-dropdown__list').innerHTML += currentItemHtml;
        };
      },
      applyFilter(){
        let filterParameter = document.querySelector('.text-filter-input').value;
        if(filterParameter.length > 1 || filterParameter.length < this.previousFilterParameterLength){
          console.log('Apply Filter');
          this.$emit('apply-filter-criteria', filterParameter);
        }
        this.previousFilterParameterLength = filterParameter.length;
      },
      sortProductCatalog(sortParameter){
        document.querySelector('.sort-input__label').innerHTML = sortParameter;
        this.$emit('apply-sort-criteria',sortParameter);
      }
    },
    onMounted() {
      this.buildSortCriteriaDropdown();
    },
}
</script>

<style>
</style>