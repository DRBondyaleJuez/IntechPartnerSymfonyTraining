<template>
  <div class="filter-menu-section">
    <div class="filters-section-wrapper">

      <h2> Filters:</h2>

      <div class="sort-section">
        <h3> Sort by: </h3>
        <div class="sort-dropdown-section">
          <button class = "sort-input">▼</button>
          <div class = "sort-dropdown">
            <ul class="sort-dropdown__list">
              <li class="sort-dropdown__list-item">Name</li>
              <li class="sort-dropdown__list-item">Price</li>
              <li class="sort-dropdown__list-item">id</li>
            </ul> 
          </div>
        </div>

      </div>

      <div class="text-filter-section">
        <input class = "text-filter-input">
        <button class = "text-filter-button" v-on:click="applyFilter()"> 🔍 </button>
      </div>

    </div>

  </div>
</template>

<script>
  module.exports = {
    name:"FilterMenu",
    methods: {
    applyFilter(){
      console.log('Apply Filter clicked');
    }
  },
}

</script>



<style>



</style>